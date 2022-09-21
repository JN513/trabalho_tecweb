<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class AdminAuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn'))
        {
            return redirect()
                ->to('/login');
        } else {
            $userModel = new UserModel();
            $id = session()->get('id');
            $data = $userModel->where('id', $id)->first();
            if($data['is_staff'] == 0){
                return redirect()
                    ->to('/');
            }
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}