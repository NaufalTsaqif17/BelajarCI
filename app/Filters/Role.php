<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Role implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika user belum login, redirect ke halaman Login
        if (!session()->has('isLoggedIn')) {
            return redirect()->to(site_url('login'));
        }

        // Jika user sudah login, cek role-nya
        $role = session()->get('role');

        // Jika role adalah 'admin', tidak diizinkan akses Contact, redirect ke Home
        if ($role == 'admin') {
            return redirect()->to(site_url('/'));
        }

        // Jika role adalah 'guest', diizinkan mengakses Contact (tidak ada return redirect)
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
