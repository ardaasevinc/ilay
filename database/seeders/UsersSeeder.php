<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Editör rolünü al
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $userAdmin = User::where('email', 'bbulutkuru@gmail.com')->first();
        $userAdmin->assignRole($superAdminRole);
        // // $editorRole = Role::where('name', 'editor')->first();

        // // if (!$editorRole) {
        // //     $this->command->error('Editor rolü bulunamadı! Önce RolePermissionSeeder çalıştırın.');
        // //     return;
        // // }

        // // // 10 editör kullanıcı oluştur
        // // $editorUsers = [
        // //     [
        // //         'name' => 'Mehmet Yılmaz',
        // //         'email' => 'mehmet.yilmaz@example.com',
        // //         'phone' => '(0532) 123-45-67',
        // //         'status' => 'active'
        // //     ],
        // //     [
        // //         'name' => 'Ayşe Kaya',
        // //         'email' => 'ayse.kaya@example.com',
        // //         'phone' => '(0533) 234-56-78',
        // //         'status' => 'active'
        // //     ],
        // //     [
        // //         'name' => 'Fatma Demir',
        // //         'email' => 'fatma.demir@example.com',
        // //         'phone' => '(0534) 345-67-89',
        // //         'status' => 'active'
        // //     ],
        // //     [
        // //         'name' => 'Ali Çelik',
        // //         'email' => 'ali.celik@example.com',
        // //         'phone' => '(0535) 456-78-90',
        // //         'status' => 'pending'
        // //     ],
        // //     [
        // //         'name' => 'Zeynep Özkan',
        // //         'email' => 'zeynep.ozkan@example.com',
        // //         'phone' => '(0536) 567-89-01',
        // //         'status' => 'active'
        // //     ],
        // //     [
        // //         'name' => 'Mustafa Avcı',
        // //         'email' => 'mustafa.avci@example.com',
        // //         'phone' => '(0537) 678-90-12',
        // //         'status' => 'active'
        // //     ],
        // //     [
        // //         'name' => 'Elif Koç',
        // //         'email' => 'elif.koc@example.com',
        // //         'phone' => '(0538) 789-01-23',
        // //         'status' => 'pending'
        // //     ],
        // //     [
        // //         'name' => 'Hasan Doğan',
        // //         'email' => 'hasan.dogan@example.com',
        // //         'phone' => '(0539) 890-12-34',
        // //         'status' => 'active'
        // //     ],
        // //     [
        // //         'name' => 'Merve Şahin',
        // //         'email' => 'merve.sahin@example.com',
        // //         'phone' => '(0540) 901-23-45',
        // //         'status' => 'active'
        // //     ],
        // //     [
        // //         'name' => 'Emre Kurt',
        // //         'email' => 'emre.kurt@example.com',
        // //         'phone' => '(0541) 012-34-56',
        // //         'status' => 'passive'
        // //     ]
        // // ];

        // // foreach ($editorUsers as $userData) {
        // //     $user = User::create([
        // //         'name' => $userData['name'],
        // //         'email' => $userData['email'],
        // //         'phone' => $userData['phone'],
        // //         'status' => $userData['status'],
        // //         'password' => Hash::make('password'), // Varsayılan şifre
        // //         'email_verified_at' => now(),
        // //     ]);

        // //     // Editör rolünü ata
        // //     $user->assignRole($editorRole);

        // //     $this->command->info("Editör kullanıcı oluşturuldu: {$user->name} ({$user->email})");
        // // }

        // $this->command->info('10 editör kullanıcı başarıyla oluşturuldu!');
        $this->command->info('Varsayılan şifre: password');
    }
}
