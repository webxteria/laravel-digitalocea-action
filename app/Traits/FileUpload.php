<?PHP
namespace App\Traits;

use App\Models\MediaFiles;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{
    public function uploadImage($file,$path){
        $filename = time().$file->getClientOriginalName();
        Storage::disk('local')->putFileAs($path,$file,$filename);
        $url = pathinfo(asset(Storage::url($path.'/'.$filename)));
        return $url;
    }
    
    public function saveToDB($model,$meta){
        $model->image()->create([
            'file_path' => $meta['dirname'].'/'.$meta['basename'],
            'file_ext'  => $meta['extension'],'file_name' => $meta['basename'],
        ]);
    }
}