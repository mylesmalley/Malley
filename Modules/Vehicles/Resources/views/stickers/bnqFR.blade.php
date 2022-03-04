{{--@extends('vehicles::layout')--}}

{{--@section('content')--}}
<canvas
    id='star'


    width="2500"
    height="2600"
    style='padding:10px;border: 1px solid blue;
    width:7.8in;'
></canvas>

{{--@endsection--}}

{{--@section('scripts')--}}
<script>

    let newstar = document.getElementById('star');
    let star = newstar.getContext('2d');

    star.strokeStyle = 'black';

    star.lineWidth = 9;

    star.strokeRect(
        15,
        15,
        1220,
        520  );




    // START OF OXYGEN TEST SECTION


    //HEADLINE TEXT
    star.font = 'bold 36px sans-serif';
    star.textBaseline = 'top'
    star.textAlign = 'center';
    star.fillStyle = 'black';

    star.fillText("TEST DU SYSTÈME D'OXYGÈNE PRINCIPALE D'AMBULANCE", 625, 25);


    star.font = ' 36px sans-serif';
    star.textBaseline = 'top'
  //  star.textAlign = 'left';
    star.fillStyle = 'black';

    // for ( let i = 1; i < 40; i++)
    // {
    //     star.fillText(`${i}`, 1250, 51 + (i * 36));
    //
    // }
    //
    // for ( let j = 1; j < 100; j+=2)
    // {
    //     star.fillText(`${j*4}`, (j * 100),100);
    //
    // }

    function line( line )
    {
        return ( line * 36) + 51;
    }
    function col( col )
    {
        return ( col * 25) ;
    }


    function write( line )
    {
        return ( line * 36) + 51;
    }


    star.fillText("L'intégrité de ce système de gaz médicaux a été testé", 625,  line(1));
    star.fillText("conformément à AMD 015 et répond aux exigences celui-ci.", 625,  line(2));
    star.fillText(``, 625,  line(3));
    //// blank
    //  star.textAlign = 'left';
    star.font = ' bold 36px sans-serif';
    star.fillText(`Conditions Initiales:`, 320,  line(5));
    star.fillText(`Conditions Finales (2 Heures):`, 930,  line(5));
    star.font = ' 36px sans-serif';
    //// blank

     star.textAlign = 'right';
    star.fillText(`Température __________ °C`, 560,  line(7));
    star.fillText(`{{ round(  $vehicle->o2_test_temperature  )  }}`, 450,  line(7));
    star.fillText(`Pression: __________ psi`, 560,  line(8));
    star.fillText(`{{ round( $vehicle->os_test_start_pressure )  }}`, 450,  line(8));

    star.fillText(`Température __________ °C`, 1150,  line(7));
    star.fillText(`{{ round( $vehicle->o2_test_temperature  )  }}`, 1025,  line(7));
    star.fillText(`Pression: __________ psi`, 1150,  line(8));
    star.fillText(`{{ round( $vehicle->os_test_final_pressure )  }}`, 1025,  line(8));


    star.textAlign = 'center';
    star.fillText(`Perte de pression maximale permise: 5 psi.  Perte de pression, ______psi`, 625,  line(9));
    star.textAlign = 'right';
    star.fillText(`{{ round( $vehicle->os_test_final_pressure - $vehicle->os_test_start_pressure, 1 ) }}`, 1080,  line(9));

    star.textAlign = 'left';

    star.fillText(`Date`, 50,  line(11));
    star.fillText(`du test ____________`, 50,  line(12));
    star.fillText(`{{ $vehicle->milestone('o2_test') ?? "O2_TEST" }}`, 200,  line(12));

    star.fillText(`Signature de l'opérateur `, 410,  line(11));
    star.fillText(`ayant fait le test: ___________________________`, 410,  line(12));


    // E N D  O F  O X Y G E N  S E C T I O N



    star.strokeRect(
        15,
        580,
        1220,
        1725
    );

    // //HEADLINE TEXT
    // star.font = 'bold 36px sans-serif';
    // star.textBaseline = 'top'
    // star.textAlign = 'center';
    // star.fillStyle = 'black';
    //
    // star.fillText("WEIGHT / PAYLOAD CERTIFICATION STICKER NOTICE", 625, line(15));
    //
    // // top text paragrap
    // star.font = ' 36px sans-serif';
    // star.textBaseline = 'top'
    // //  star.textAlign = 'left';
    // star.fillStyle = 'black';
    //
    // star.fillText(`This vehicle, as manufactured, conforms to the payload requirements of `, 625,  line(17));
    // star.fillText(`the Federal Ambulance Specification KKK-A-1822. Users shall not load `, 625,  line(18));
    // star.fillText(`vehicles above the GVWR. Users should determine that the actual load, to `, 625,  line(19));
    // star.fillText(`be placed on the vehicle does not exceed the usable payload. `, 625,  line(20));
    //
    //

    star.font = 'bold 36px sans-serif';
    star.textBaseline = 'top'
    star.textAlign = 'center';
    star.fillStyle = 'black';

    // star.fillText(`CERTIFICAT DE POIDS / CHARGE UTILE`, 625, line(15));
    star.fillText(`CERTIFICAT DE CAPACITÉ DE CHARGE/POIDS`, 625, line(15));

    star.fillText(`ATTENTION`, 625, line(17));

    star.font = '36px sans-serif';

    star.fillText(`CETTE AMBULANCE, TELLE QU'ELLE EST CONSTRUITE, EST`, 625, line(18));
    star.fillText(`COMFORME AUX EXIGENCES DE CHARGE UTILE RESTANTE`, 625, line(19));
    star.fillText(`MINIMALE DE LA NORME BNQ 1013-110. LES UTILISATEURS NE`, 625, line(20));
    star.fillText(`DOIVENT PAS DÉPASSER LE POIDS NOMINAL BRUT (PNBV)`, 625, line(21));
    star.fillText(`SPÉCIFIÉ PAR LE CONSTRUCTEUR DU CHÂSSIS.`, 625, line(22));
    star.fillText(`LES UTILISATEURS DOIVENT S'ASSURER QUE LA CHARGE UTILE`, 625, line(23));
    star.fillText(`AJOUTÉE À L'AMBULANCE NE DÉPASSE PAS LA CHARGE UTILE`, 625, line(24));
    star.fillText(`RESTANTE.`, 625, line(25));

    star.font = 'bold 36px sans-serif';
    star.fillText(`CAUTION`, 625, line(27));

    star.font = '36px sans-serif';

    star.fillText(`THIS AMBULANCE, AS MANUFACTURED, CONFORMS TO THE`, 625, line(28));
    star.fillText(`MINIMAL PAYLOAD REQUIREMENTS OF STANDARD BNQ 1013-110.`, 625, line(29));
    star.fillText(`USERS SHALL NOT LOAD VEHICLE ABOVE THE GROSS VEHICLE`, 625, line(30));
    star.fillText(`WEIGHT RATING (GVWR) SPECIFIED BY THE CHASSIS`, 625, line(31));
    star.fillText(`MANUFACTURER. USERS SHALL ENSURE THAT ANY ADDED`, 625, line(32));
    star.fillText(`PAYLOAD DOES NOT EXCEED THE PAYLOAD ALLOWANCE.`, 625, line(33));










    star.font = ' 28px sans-serif';

    star.fillText(`_____________________________________________`, 625,  line(35));
    star.fillText(`NOM DU FABRICANT D'AMBULANCE`, 625,  line(36));


    star.fillText(`_________________________________              _____________    `   , 625,  line(38));
    star.fillText(`          MODÈLE DU CHÂSSIS.                            DATE DE FABRICATION `, 625,  line(39));



    star.font = 'bold 36px sans-serif';
    star.fillText(`MALLEY INDUSTRIES INC.`, 625,  line(34.9));
    star.fillText(`      {{ $vehicle->make }} {{ $vehicle->model }}                              `, 625,  line(37.9));
    star.fillText(`     {{ $vehicle->year }}    `, 900,  line(37.9));


    // LIST
    star.textAlign = 'left';

    star.font = ' 32px sans-serif';
    star.fillText(`1.`, 40,  line(41));
    star.fillText(`TYPE DE VÉHICULE, MODÈLE, # PRODUCTION`, 80,  line(41));
    star.fillText(`__________________`, 900,  line(41));
    star.fillText(`{{ $vehicle->ambulance_type }} | {{ $vehicle->ambulance_model }} | {{ $vehicle->malley_number }}`, 810,  line(41));


        star.fillText(`2.`, 40,  line(42));
        star.fillText(`PNBE AVANT DU FABRICANT DU CHÂSSIS`, 80,  line(42));
        star.fillText(`____________KG`, 900,  line(42));
        star.fillText(`{{ number_format( $vehicle->oem_front_gawr * 0.453592 ) }}`, 950,  line(42));



     star.fillText(`3.`, 40,  line(43));
     star.fillText(`PNBE ARRIÈRE DU FABRICANT DU CHÂSSIS`, 80,  line(43));
     star.fillText(`____________KG`, 900,  line(43));
     star.fillText(`{{ number_format( $vehicle->oem_rear_gawr * 0.453592 ) }}`, 950,  line(43));



       star.fillText(`4.`, 40,  line(44));
       star.fillText(`PNBV DU FABRICANT DU CHÂSSIS`, 80,  line(44));
       star.fillText(`____________KG`, 900,  line(44));
       star.fillText(`{{ number_format( $vehicle->oem_gvwr * 0.453592 ) }}`, 950,  line(44));




       star.fillText(`5.`, 40,  line(45));
       star.fillText(`CHARGE UTILE MINIMALE SELON BNQ 1013-110A`, 80,  line(45));
       star.fillText(`COMME SPÉCIFIÉ DANS (CLAUSE 6.1.2)`, 110,  line(46));
       star.fillText(`____________KG`, 900,  line(46));
       star.fillText(`680`, 950,  line(46));


           star.fillText(`6.`, 40,  line(47));
           star.fillText(`POIDS À VUE - AVANT DU VÉHICULE DE BASE`, 80,  line(47));
           star.fillText(`____________KG`, 900,  line(47));
           star.fillText(`{{ number_format( $vehicle->front_axel_weight_with_fuel * 0.453592 ) }}`, 950,  line(47));


      star.fillText(`7.`, 40,  line(48));
      star.fillText(`POIDS À VUE - ARRIÈRE DU VÉHICULE DE BASE`, 80,  line(48));
      star.fillText(`____________KG`, 900,  line(48));
      star.fillText(`{{  number_format($vehicle->rear_axel_weight_with_fuel * 0.453592 )  }}`, 950,  line(48));


     star.fillText(`8.`, 40,  line(49));
     star.fillText(`POIDS À VUE DU VÉHICULE DE BASE`, 80,  line(49));
     star.fillText(`(ITEM 6 PLUS ITEM 7)(PARA 3.5.1)`, 110,  line(50));
     star.fillText(`____________KG`, 900,  line(50));
     star.fillText(`{{ number_format( ( $vehicle->front_axel_weight_with_fuel + $vehicle->rear_axel_weight_with_fuel )  * 0.453592 ) }}`, 950,  line(50));


        star.fillText(`9.`, 40,  line(51));
        star.fillText(`CHARGE UTILE DU VÉHICULE DE BASE`, 80,  line(51));
        star.fillText(`(ITEM 4 MOINS ITEM 8)`, 110,  line(52));
        star.fillText(`DOIT ÊTRE EQUIVALENT OU PLUS HAUT`, 110,  line(53));
        star.fillText(`____________KG`, 900,  line(53));
    {{--star.fillText(`{{ number_format( $vehicle->payload * 0.453592 )  }}`, 950,  line(53));--}}
    star.fillText(`{{ number_format( ($vehicle->oem_gvwr - ( $vehicle->front_axel_weight_with_fuel + $vehicle->rear_axel_weight_with_fuel ) ) * 0.453592 )  }}`, 950,  line(53));

    star.fillText(`10.`, 33,  line(54));
    star.fillText(`POIDS TOTAL DES OPTIONS SPÉCIFIC`, 80,  line(54));
    star.fillText(`SUR CEVÉHICULE`, 110,  line(55));
    star.fillText(`____________KG`, 900,  line(55));
    star.fillText(`{{ number_format(($vehicle->weight_of_options ?? 0)  * 0.453592 )  }}`, 950,  line(55));





    star.fillText(`11.`, 33,  line(56));
      star.fillText(`CHARGE UTILE RESTANTE `, 80,  line(56));
    star.fillText(`(VRAI POIDS POUVANT ÊTRE AJOUTÉ PAR`, 110,  line(57));
    star.fillText(` L'UTILISATEUR) (ITEM 9 MOINS ITEM 10)`, 110,  line(58));
      star.fillText(`____________KG`, 900,  line(58));
{{--      star.fillText(`{{ number_format(( $vehicle->payload - $vehicle->weight_of_options ) * 0.453592 )  }}`, 950,  line(58));--}}

    star.fillText(`{{ number_format(( ($vehicle->oem_gvwr - ( $vehicle->front_axel_weight_with_fuel + $vehicle->rear_axel_weight_with_fuel ) ) - $vehicle->weight_of_options ) * 0.453592 )  }}`, 950,  line(58));

    // FOOTER

    star.font = 'bold 36px sans-serif';
    star.textBaseline = 'top'
    star.textAlign = 'center';
    star.fillStyle = 'black';

    star.fillText("CE COLLANT DOIT ÊTRE INSTALLER SUR LE", 625, line(60));
    star.fillText("MODULE À UN ENDROIT VISIBLE", 625, line(61));

    star.font = '36px sans-serif';











    star.strokeRect(
        1265,
        15,
        1220,
        1950);


    star.font = 'bold 36px sans-serif';
    star.textBaseline = 'top'
    star.textAlign = 'center';
    star.fillStyle = 'black';

    star.fillText("CERTIFICAT DE TEST COURANT ÉLECTRIQUE ET AMD 005", 1850, 25);


    star.font = ' 32px sans-serif';
    //  star.textAlign = 'left';
    star.fillStyle = 'black';

    star.textAlign = 'left';

    star.fillText(`A`, col(52), line(1));




    star.fillText(`Les données ci-dessous sont basées sur allumé les équipements`,col(54), line(1));
    star.fillText(`électriques suivants et la/les charge(s) électrique(s) simultanément.`,col(54), line(2));

    star.fillText(`1`, col(53), line(3));
    star.fillText(`Système d'ignition`,col(56), line(3));

    star.fillText(`2`, col(53), line(4));
    star.fillText(`Phare principaux (basse intensité) incluant tous les `,col(56), line(4));
    star.fillText(`feux de roule selon NSVAC`,col(56), line(5));

    star.fillText(`3`, col(53), line(6));
    star.fillText(`Essuie glace (basse vitesse)`,col(56), line(6));

    star.fillText(`4`, col(53), line(6+1));
    star.fillText(`A/C de la cabine avant (A/C et ventilateur en position`,col(56), line(6+1));
    star.fillText(`maximum)`,col(56), line(7+1));

    star.fillText(`5`, col(53), line(8+1));
    star.fillText(`Radiocommunication en mode de réception (charge équivalente,`,col(56), line(8+1));
    star.fillText(`si non équipé - 5A)`,col(56), line(8+2));

    star.fillText(`6`, col(53), line(9+2));
    star.fillText(`Éclairage intérieur du module (haute intensité)`,col(56), line(9+2));

    star.fillText(`7`, col(53), line(10+2));
    star.fillText(`A/C du module (A/C et ventilateur en position maximum)`,col(56), line(10+2));

    star.fillText(`8`, col(53), line(12+1));
    star.fillText(`Système de feux d'urgence en mode ''clear-right-of-way''`,col(56), line(12+1));
    star.fillText(`(selon KKK 3.8.2)`,col(56), line(13+1));

    star.fillText(`9`, col(53), line(14+1));
    star.fillText(`20 ampère de charge (équipement médical ou équivalent)`,col(56), line(14+1));

    star.fillText(`10`, col(53), line(15+1));
    star.fillText(`Lumières de scène côté droit et gauche`,col(56), line(15+1));

    star.fillText(`11`, col(53), line(16+1));
    star.fillText(`Lumières de scène arrière`,col(56), line(16+1));

    star.fillText(`12`, col(53), line(17+1));
    star.fillText(`Tous les équipeents et éclairages optionnels 12V DC`,col(56), line(17+1));


    star.fillText(`Ce véhicule est  X  / n'est pas ___ équipé d'un système de gestion de courant. `, col(52), line(19+1));




    star.fillText(`NOTÉ: SI CE VÉHICULE EST MUNI D'UN SYSTÈME DE GESTION DE ,`, col(52), line(21+1));
    star.fillText(`COURANT CERTAINES FONCTIONS LISTÉES CI-DESSUS PEUVENT AVOIR `, col(52), line(22+1));
    star.fillText(`ÉTÉ AUTOMATIQUEMENT COUPÉES DE LEUR ALIMENTATION PAR CE   `, col(52), line(23+1));
    star.fillText(`SYSTÈME. SI MUNI D'UN SYSTÈME DE DÉVIATION DE COURANT, `, col(52), line(24+1));
    star.fillText(`CELUI-CI DOIT ÊTRE ACTIONNÉ POUR PERMETTRE D'ATTEINDRE `, col(52), line(25+1));
    star.fillText(`LA CONSOMMATION MAXIMALE.`, col(52), line(26+1));




    star.fillText(`B`, col(52), line(28+1));
    star.fillText(`Nom du fabricant d'ambulance`,col(54), line(28+1));
    star.fillText(`________________________`, col(78), line(28+1));
    star.fillText(`Malley Industries Inc.`, col(80), line(28+1));

    star.fillText(`C`, col(52), line(29+1));
    star.fillText(`Type d'ambulance | Modèle`,col(54), line(29+1));
    star.fillText(`________________________`, col(78), line(29+1));
    star.fillText(`{{ $vehicle->ambulance_type }} | {{ $vehicle->model }}`, col(80), line(29+1));

    star.fillText(`D`, col(52), line(30+1));
    star.fillText(`Fabricant du châssis`,col(54), line(30+1));
    star.fillText(`________________________`, col(78), line(30+1));
    star.fillText(`{{ $vehicle->make }}`, col(80), line(30+1));

    star.fillText(`E`, col(52), line(31+1));
    star.fillText(`Numéro de série du véhicule (VIN)`,col(54), line(31+1));
    star.fillText(`________________________`, col(78), line(31+1));
    star.fillText(`{{ $vehicle->vin }}`, col(80), line(31+1));

    star.fillText(`F`, col(52), line(32+1));
    star.fillText(`Données du système de charge`,col(54), line(32+1));

    star.fillText(`1`, col(53), line(33+1));
    star.fillText(`Marque / modèle alternateur / générateur`,col(56), line(33+1));
    star.fillText(`________________________`, col(78), line(33+1));
    star.fillText(`OEM`, col(80), line(33+1));

    star.fillText(`2`, col(53), line(34+1));
    star.fillText(`Capacité maximum 12V DC selon le fabricant`, col(56), line(34+1));
    star.fillText(`à 200F (93C) à 14V DC`,col(56), line(35+1));
    star.fillText(`_______`, col(89.5), line(35+1));
    star.fillText(`A`, col(95), line(35+1));
    star.fillText(`{{ $vehicle->alternator_amperage}}`, col(90.5), line(35+1));


    star.fillText(`G`, col(52), line(36+1));
    star.fillText(`Données d'essais`,col(54), line(36+1));

        star.fillText(`1`, col(53), line(37+1));
        star.fillText(`Plus bas voltage au point principal avec charge 1-11`,col(56), line(37+1));
        star.fillText(`_______`, col(89.5), line(37+1));
        star.fillText(`V`, col(95), line(37+1));
        star.fillText(`{{ round( $vehicle->load_test_1_lowest ,1) }}`, col(90.5), line(37+1));

       star.fillText(`2`, col(53), line(38+1));
        star.fillText(`Plus bas voltage au point principal avec charge 1-12`,col(56), line(38+1));
        star.fillText(`_______`, col(89.5), line(38+1));
        star.fillText(`V`, col(95), line(38+1));
        star.fillText(`{{ round( $vehicle->load_test_2_lowest, 1)}}`, col(90.5), line(38+1));

        star.fillText(`3`, col(53), line(39+1));
        star.fillText(`Vitesse du moteur`,col(56), line(39+1));
        star.fillText(`_______`, col(89.5), line(39+1));
        star.fillText(`RPM`, col(95), line(39+1));
        star.fillText(`1500`, col(90.5), line(39+1));


    star.fillText(`4`, col(53), line(40+1));
    star.fillText(`Consommation courant DC au point principal`,col(56), line(40+1));
    star.fillText(`avec charge 1-11`,col(56), line(40+2));
    star.fillText(`_______`, col(89.5), line(40+2));
    star.fillText(`A`, col(95), line(40+2));
    star.fillText(`{{ round( $vehicle->load_test_1_highest,1 ) }}`, col(90.5), line(40+2));



    star.fillText(`5`, col(53), line(41+2));
    star.fillText(`Consommation courant DC au point principal avec `,col(56), line(41+2));
    star.fillText(`charge 1-12 sans système de gestion du courant`,col(56), line(42+2));
    star.fillText(`_______`, col(89.5), line(42+2));
    star.fillText(`A`, col(95), line(42+2));
    star.fillText(`{{ round( $vehicle->load_test_2_highest,1 ) }}`, col(90.5), line(42+2));




    star.fillText(`H`, col(52), line(43+2));
    star.fillText(`Charge de réserve`,col(54), line(43+2));

        star.fillText(`1`, col(53), line(44+2));
        star.fillText(`Charge de réserve (+) surcharge (-) avec charge 1-11`,col(56), line(44+2));
        star.fillText(`_______`, col(89.5), line(44+2));
        star.fillText(`A`, col(95), line(44+2));
        star.fillText(`{{ round(  $vehicle->alternator_amperage -$vehicle->load_test_1_highest  ,1) }}`, col(90.5), line(44+2));

    star.fillText(`2`, col(53), line(45+2));
    star.fillText(`Charge de réserve (+) surcharge (-) avec charge 1-12`,col(56), line(45+2));
    star.fillText(`sans système de gestion du courant`,col(56), line(46+2));
    star.fillText(`_______`, col(89.5), line(46+2));
    star.fillText(`A`, col(95), line(46+2));
    star.fillText(`{{ round(  $vehicle->alternator_amperage -$vehicle->load_test_2_highest,1 ) }}`, col(90.5), line(46+2));


    star.fillText(`I`, col(52), line(47+2));
    star.fillText(`Date des tests`,col(56), line(47+2));
    star.fillText(`________________________`, col(78), line(47+2));
    star.fillText(`{{ $vehicle->milestone('load_test') ?? "LOAD_TEST" }}`, col(80), line(47+2));


    star.fillText(`J`, col(52), line(48+2));
    star.fillText(`Le système électrique à été essayer et conforme `,col(56), line(48+2));
    star.fillText(`avec le standard AMD 005`,col(56), line(49+2));


    /**
     * malley info sticker
     */

    star.strokeRect(
        1265,
        2015,
        1220,
        217);

    star.drawImage( bg_logo, col(52) , line(52+3) );
    star.textAlign = 'right';

    star.fillText(`Malley Industries Inc.`, col(98), line(52+3));
    star.fillText(`1100 Aviation Avenue`, col(98), line(53+3));
    star.fillText(`Dieppe, New Brunswick, Canada`, col(98), line(54+3));
    star.fillText(`E1A 9A3`, col(98), line(55+3));

    star.textAlign = 'left';
    star.fillText(`Tel: 1 (877) 859-8591`, col(52), line(54+3));
    star.fillText(`Fax: 1 (877) 857-1745`, col(52), line(55+3));

    star.textAlign = 'center';
    star.fillText(`www.malleyindustries.com`, 1875, line(56+3));


</script>
