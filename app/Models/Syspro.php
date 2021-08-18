<?php

namespace App\Models;

use \App\Models\BaseModel;
use Illuminate\Support\Facades\DB;

class Syspro extends BaseModel
{

	/**
	 * The connection name for the model.
	 *
	 * @var string
	 */
	protected $connection = 'syspro';


	/**
	 * @return array
	 */
	public function workCentres(): array
	{
		$raw = DB::connection( 'syspro' )
			->table( 'BomWorkCentre' )
			->select( [ 'WorkCentre', 'Description' ] )
			->get();
		$raw->toArray();

		$clean = [];

		foreach ( $raw as $r ) {
			$clean[ trim( $r->WorkCentre ) ] = trim( $r->Description );
		}
		return $clean;
	}


	/**
	 * @return mixed
	 */
	public function workOrders()
	{
		return DB::connection( 'syspro' )
			->table( 'WipMaster' )
			->selectRaw( " RTRIM( Job ) AS Job " )
			->selectRaw( " RTRIM( JobDescription ) AS JobDescription " )
			->selectRaw( " RTRIM( CustomerName ) AS CustomerName " )
			->selectRaw( " RTRIM( JobClassification ) AS JobClassification " );
		//	->select(['Job','JobDescription','JobClassification']);
	}


	/**
	 * @return mixed
	 */
	public function activeWorkOrders()
	{
		return $this->workOrders()
			->where( 'Complete', 'N' )
			->where( 'ConfirmedFlag', 'Y' );
	}


	/**
	 * @return mixed
	 */
	public function workOrderPrefixes()
	{
		return $this->jobPrefixes();

	}

    /**
     * @param bool $active
     * @return \Illuminate\Support\Collection
     */
	public static function jobPrefixes( $active = false )
	{
		$result = DB::connection( 'syspro' )
			->table( 'WipMaster' );
			// only grab active ones?
            if ( !$active )
            {
                $result->where( 'Complete', 'N' );
            }

			$result->selectRaw( " RTRIM( JobClassification ) AS JobClassification " )
			->groupBy( 'JobClassification' );

		return $result->pluck( 'JobClassification' );
	}


	/**
	 * @param string $category
	 * @return mixed
	 */
	public function activeWorkOrdersInCategory( string $category = "A" )
	{
		return $this->activeWorkOrders()
			->where( 'JobClassification', $category )
			->get();
	}


	/**
	 * @param string $keyword
	 * @param int $limit
	 * @param int $offset
	 * @return mixed
	 */
	public function searchJobs( string $keyword, int $limit = 25, int $offset = 0 )
	{
		return DB::connection( 'syspro' )
			->table( 'WipMaster' )
			->where( 'Job', 'like', "%{$keyword}%" )
			->orWhere( 'JobDescription', 'like', "%{$keyword}%" )
			->orWhere( 'CustomerName', 'like', "%{$keyword}%" )
			->selectRaw( " RTRIM( Job ) AS Job " )
			->selectRaw( " RTRIM( JobDescription ) AS JobDescription " )
			->selectRaw( " RTRIM( CustomerName ) AS CustomerName " )
			->limit( $limit )
			->offset( $offset );
	}

	/**
	 * @param string $keyword
	 * @return mixed
	 */
	public function getJob( string $keyword )
	{
		return DB::connection( 'syspro' )
			->table( 'WipMaster' )
			->where( 'Job', $keyword )
			->first();
	}


	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeOpen( $query )
	{
		return $query
			->table( 'WipMaster' )
			//->connection('syspro')
			->where( 'Complete', 'N' );
	}


	/**
	 * returns recently received items from Syspro inventory for a given department
	 *
	 * @param string $dept
	 * @return mixed
	 */
	public static function recentlyReceivedToInventory( string $dept = "EL" )
	{
		return DB::connection( 'syspro' )
			->table( DB::raw( 'InvMaster,
					PorMasterDetail,
					PorMasterHdr,
					InvMaster AS IM1,
					InvWarehouse AS IW1' ))
			->select( DB::raw("
				PorMasterDetail.MStockCode AS [StockCode],
				RTRIM(IM1.Description)+' '+RTRIM(IM1.LongDesc) AS [Description],
				PorMasterDetail.MOrderQty AS [Ordered],
				PorMasterDetail.MReceivedQty AS [Received],
				PorMasterDetail.PurchaseOrder AS [PurchaseOrder],
				CONVERT(VARCHAR(12), PorMasterHdr.OrderEntryDate, 107) AS [OrderPlaced], CONVERT(VARCHAR(12), PorMasterHdr.OrderDueDate, 107) AS [ESTArrivalDate],
				CAST(InvMaster.LeadTime AS VARCHAR(10))+CAST(' days' AS VARCHAR(10)) AS [LeadTime],
				CONVERT(VARCHAR(12),PorMasterDetail.MLastReceiptDat,107) AS [ArrivedOn],
				IM1.LeadTime-DATEDIFF(day,PorMasterHdr.OrderEntryDate,GETDATE()) AS [DaysLeft]
			"))
			->whereRaw("
				PorMasterHdr.PurchaseOrder = PorMasterDetail.PurchaseOrder
				AND InvMaster.StockCode = PorMasterDetail.MStockCode
				AND PorMasterDetail.MStockCode = IM1.StockCode
				AND PorMasterDetail.MStockCode = IW1.StockCode
				AND PorMasterHdr.CancelledFlag <> 'Y'
				AND PorMasterDetail.MLastReceiptDat > DATEADD(Day,-7,GetDate())
				AND IW1.DefaultBin LIKE ?
				",["{$dept}%"])

			->orderBy( "MStockCode", "ASC" )
			->get();
	}


	/**
	 * returns inventory on order from Syspro for a givne department
	 *
	 * @param string $dept
	 * @return mixed
	 */
	public static function inventoryOnOrder( string $dept = "EL", string $column = "StockCode", string $order = "ASC" )
	{
		return DB::connection( 'syspro' )
			->table( DB::raw( 'InvMaster,
					PorMasterDetail,
					PorMasterHdr,
					InvMaster AS IM1,
					InvWarehouse AS IW1' ))
			->select( DB::raw("
				RTRIM(PorMasterDetail.MStockCode) AS [StockCode],
				RTRIM(IM1.Description)+' '+RTRIM(IM1.LongDesc) AS [Description],
				PorMasterDetail.MOrderQty AS [Ordered],
				PorMasterDetail.MReceivedQty AS [Received],
				PorMasterDetail.PurchaseOrder AS [PO],
				CONVERT(VARCHAR(12), PorMasterHdr.OrderEntryDate, 107) AS [OrderPlaced],
				CONVERT(VARCHAR(12), PorMasterHdr.OrderDueDate, 107) AS [ESTArrivalDate],
				CAST(InvMaster.LeadTime AS VARCHAR(10))+CAST(' days' AS VARCHAR(10)) AS [LeadTime], DATEDIFF(day,OrderEntryDate, GetDate()) AS [DaysPassed],
			IM1.LeadTime-DATEDIFF(day,PorMasterHdr.OrderEntryDate,GETDATE()) AS [DaysLeft]


			"))
			->whereRaw("
				PorMasterHdr.PurchaseOrder = PorMasterDetail.PurchaseOrder
				AND InvMaster.StockCode = PorMasterDetail.MStockCode
				AND PorMasterDetail.MStockCode = IM1.StockCode
				AND PorMasterDetail.MStockCode = IW1.StockCode
				AND PorMasterDetail.MCompleteFlag <> 'Y'
				AND PorMasterDetail.MOrderQty-PorMasterDetail.MReceivedQty <> 0
				AND PorMasterHdr.CancelledFlag <> 'Y'
				AND IW1.DefaultBin LIKE ?
				",["{$dept}%"])

			->orderBy( $column, $order )
			->get();
	}


	public static function openPartsBuildOrders( string $dept = "EL", string $column = "StockCode", string $order = "ASC" )
	{

		$query = DB::connection( 'syspro' )
			->table( DB::raw( 'SysproCompanyM.dbo.WipMaster WM' ))
			->select( DB::raw("
				StockCode,
				StockDescription AS [Description],
				Job as [PBJob],
				CAST(QtyToMake AS DECIMAL(4,0)) AS [JobQty],
				CAST(QtyManufactured AS DECIMAL(4,0)) AS [QtyMade],
				CONVERT(VARCHAR(12),JobStartDate,107) AS [DateOpened],
				CAST('Open for ' AS VARCHAR(10))+CAST(Datediff(day,JobStartDate,GetDate()) AS VARCHAR(10))+ CAST(' days' as varchar(20)) as [Status]
			"))
			->where('Complete','<>','Y')
			->where('Job','LIKE','PB%');


			// Plastics
			if ($dept === "PL")
			{

				$query->whereRaw("(StockCode Like 'MI-PAM%'
						OR StockCode Like 'MI-CUS%'
						OR StockCode Like 'MI-PMY%'
						OR StockCode Like 'MI-PUF%'
						OR StockCode Like 'MI-LIN%')");
			}

			// MEtalfab
			if ($dept === "MIL")
			{
				$query->whereRaw("(StockCode LIKE 'MI-WAM%'
						OR StockCode Like 'MI-IAM%'
						OR StockCode Like 'MI-WUF%'
						OR StockCode Like 'MI-AAM%')");
			}

			// Mill
			if ($dept === "MF")
			{
				$query->whereRaw("(StockCode LIKE 'MI-FAM%'
						OR StockCode Like 'MI-FUF%'
						OR StockCode Like 'MI-FMY%')");
			}

			// Electrical
			if ($dept === "EL")
			{
				$query->whereRaw("(StockCode LIKE 'MI-EAM%')");
			}



			// Electrical
			if ($dept === "UPH")
			{
				$query->whereRaw("(StockCode LIKE 'MI-UAM%')");
			}

			// Graphics
			if ($dept === "DEC")
			{
				$query->whereRaw("(StockCode LIKE 'MI-DEC%')");
			}




			$query->orderBy('StockCode','ASC');


			return $query->get();
	}



	public static function kanbanStockCodes()
	{
//	{
//		$query = DB::connection( 'syspro' )
//			->table( DB::raw( 'SysproCompanyM.dbo.InvMaster InvMaster,
//            SysproCompanyM.dbo.InvWarehouse InvWarehouse' ))
//			->selectRaw("InvMaster.StockCode,
//            InvMaster.Description,
//            InvMaster.LongDesc,
//            InvMaster.PartCategory,
//            InvWarehouse.DefaultBin, CAST('WH' AS VARCHAR(2)) AS [Group ID],
//            MAX(IVM.EntryDate) as [Latest Build]
//
//
//            LEFT OUTER JOIN InvMovements AS IVM ON IVM.StockCode = InvWarehouse.StockCode
//             AND InvWarehouse.Warehouse='01' AND IVM.TrnType = 'R'
//			WHERE InvMaster.StockCode = InvWarehouse.StockCode
//
//            ")
//			->whereRaw( "InvMaster.StockCode = InvWarehouse.StockCode
//            AND ((InvMaster.PartCategory='M')
//            AND (InvWarehouse.DefaultBin Between 'A00A' And 'K99Z'))
//            AND (YEAR(IVM.EntryDate) >2017 )" )
//			->groupBy( DB::raw("InvMaster.StockCode,
//            InvMaster.Description,
//            InvMaster.LongDesc,
//            InvMaster.PartCategory,
//            InvWarehouse.DefaultBin") )
//			->orderBy('StockCode')
//			->get();
//
//		return $query;


		$query =  DB::connection('syspro')
			->select( DB::raw("SELECT InvMaster.StockCode,
            InvMaster.Description,
            InvMaster.LongDesc,
            InvMaster.PartCategory,
            InvWarehouse.DefaultBin, CAST('WH' AS VARCHAR(2)) AS [GroupID],
            MAX(IVM.EntryDate) as [LatestBuild]
FROM SysproCompanyM.dbo.InvMaster InvMaster,
            SysproCompanyM.dbo.InvWarehouse InvWarehouse
            LEFT OUTER JOIN InvMovements AS IVM ON IVM.StockCode = InvWarehouse.StockCode AND InvWarehouse.Warehouse='01' AND IVM.TrnType = 'R'
WHERE InvMaster.StockCode = InvWarehouse.StockCode
            AND ((InvMaster.PartCategory='M')
            AND (InvWarehouse.DefaultBin Between 'A00A' And 'K99Z'))
            AND YEAR(IVM.EntryDate) >2017
GROUP BY InvMaster.StockCode,
            InvMaster.Description,
            InvMaster.LongDesc,
            InvMaster.PartCategory,
            InvWarehouse.DefaultBin
ORDER BY StockCode" ) );

		return $query;

	}









	public static function finishedGoods( string $dept = "MI-LIN", string $column = "IW.StockCode", string $order = "ASC" )
	{
		$query = DB::connection( 'syspro' )
			->table( DB::raw( 'SysproCompanyM.dbo.InvMaster IM,  SysproCompanyM.dbo.InvWarehouse IW' ))
			->select( DB::raw("
					IW.StockCode AS [StockCode],
		            CAST(RTRIM(IM.Description) + ' ' + RTRIM(IM.LongDesc) AS VARCHAR(MAX)) AS [Description],
		            IW.UnitCost AS [UnitCost],
		            IW.QtyOnHand AS [OnHand],
		            IW.QtyOnOrder AS [OnOrder],
		            IW.QtyAllocated+IW.QtyAllocatedWip AS [AllocatedWIP],
		            ((IW.QtyOnHand+ IW.QtyOnOrder)-(IW.QtyAllocated+IW.QtyAllocatedWip)) AS [FutureFree]
				") )
			->whereRaw('IM.StockCode = IW.StockCode')
			->where('IW.StockCode', 'like', 'MI-LIN%')
			->whereRaw("IW.DateLastStockMove > DATEADD(YEAR,-2,GETDATE())")
			->orderBy('IW.StockCode', "ASC");


		return $query->get();
	}


}
