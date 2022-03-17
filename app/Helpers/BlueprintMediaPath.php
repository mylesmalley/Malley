<?php
/**
 * Created by PhpStorm.
 * User: mmalley
 * Date: 2018-04-18
 * Time: 11:51 AM
 */

namespace App\Helpers;

//use Spatie\MediaLibrary\Support\PathGenerator;

//use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class BlueprintMediaPath implements PathGenerator
{
    public function getPath(Media|\Spatie\MediaLibrary\MediaCollections\Models\Media $media) : string
    {
        //    return md5($media->id).'/';

        switch ($media->model_type) {
            case \App\Models\Blueprint::class:
                return 'Blueprint/'.$media->model_id.'/'.$media->collection_name.'/';
                break;
            case \App\Models\Company::class:
                return 'Company/'.$media->model_id.'/'.$media->collection_name.'/';
                break;
//	        case "App\Models\Album":
//		        return 'Album/'.$media->model_id.'/'.$media->collection_name.'/';
//		        break;
            case \App\Models\Album::class:
                return 'Album/'.$media->model_id.'/'.$media->id.'/';
                break;
            case "App\Models\Bug":
                return 'Bug/'.$media->model_id.'/'.$media->id.'/';
                break;
            case \App\Models\WarrantyClaim::class:
                return 'WarrantyClaim/'.$media->model_id.'/'.$media->id.'/';
                break;
//		    case "App\Programs\FleetAudit\Models\FleetAudit":
//			    return 'FleetAudit/'.$media->model_id.'/'.$media->id.'/';
//			    break;

            case "App\Models\FleetAudit":
                return 'FleetAudit/'.$media->model_id.'/'.$media->id.'/';
                break;
            case \App\Models\BugReport::class:
                return 'BugReport/'.$media->model_id.'/'.$media->id.'/';
                break;
//            case "App\Programs\Documents\Models\Document":
//                return 'Document/'.$media->model_id.'/'.$media->id.'/';
//                break;
            case "App\Models\Document":
                return 'Document/'.$media->model_id.'/'.$media->id.'/';
                break;
//            case "App\Programs\Documents\Models\Folder":
//                return 'Folder/'.$media->model_id.'/'.$media->id.'/';
//                break;
            case \App\Models\Folder::class:
                return 'Folder/'.$media->model_id.'/'.$media->id.'/';
                break;
            case \App\Models\Vehicle::class:
                return 'Vehicle/'.$media->model_id.'/'.$media->id.'/';
                break;
            case \App\Models\BaseVan::class:
                return 'BaseVan/'.$media->model_id.'/'.$media->collection_name.'/';
                break;
            case \App\Models\Option::class:
                return 'Option/'.$media->model_id.'/'.$media->id.'/';
                break;
            case \App\Models\Layout::class:
                return 'Layout/'.$media->model_id.'/'.$media->collection_name.'/';
                break;
            default:
                return 'Blueprint/'.$media->model_id.'/'.$media->collection_name.'/';
        }

        //  return 'B-'.$media->model_id.'/'.$media->collection_name.'/';
    }

    public function getPathForConversions(Media|\Spatie\MediaLibrary\MediaCollections\Models\Media $media) : string
    {
        return $this->getPath($media).'c/';
    }

    public function getPathForResponsiveImages(Media|\Spatie\MediaLibrary\MediaCollections\Models\Media $media): string
    {
        return $this->getPath($media).'/cri/';
    }
}
