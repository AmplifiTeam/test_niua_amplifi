<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
class UserAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    { 
        $logedInUserEmail=session()->get('FrontendLoggedInUser');
        if(!$logedInUserEmail)
        {
            return redirect()->to(base_url('/'));
        }
    }



    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
?>