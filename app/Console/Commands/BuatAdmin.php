<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BuatAdmin extends Command
{
    protected $signature = 'admin:buat {email? : Email admin} {--nama=Admin : Nama admin} {--password= : Password (jika kosong akan ditanyakan)}';
    protected $description = 'Buat atau perbarui akun admin Rasa Meutuah';

    public function handle(): int
    {
        $email = (string) ($this->argument('email') ?: $this->ask('Email admin'));
        $email = trim(preg_replace('/[^\x20-\x7E]/', '', $email)); // buang karakter tersembunyi
        $pass  = (string) ($this->option('password') ?: $this->secret('Password (minimal 8 karakter)'));

        $v = Validator::make(
            ['email' => $email, 'password' => $pass],
            ['email' => 'required|email', 'password' => 'required|min:8']
        );

        if ($v->fails()) {
            foreach ($v->errors()->all() as $e) {
                $this->error($e);
            }

            return self::FAILURE;
        }

        Admin::updateOrCreate(['email' => $email], [
            'name'     => $this->option('nama'),
            'password' => Hash::make($pass),
        ]);

        $this->info("Akun admin siap: {$email}");

        return self::SUCCESS;
    }
}
