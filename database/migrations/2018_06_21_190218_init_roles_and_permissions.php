<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;

class InitRolesAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Define roles
        // DLMSA is superAdmin
        $dlmsa = Bouncer::role()->create([
            'name' => 'dlmsa',
            'title' => 'DLMSA'
            ]);

        // 
        $admin = Bouncer::role()->create([
            'name' => 'admin',
            'title' => 'Lab Admin'
            ]);

        $assistant = Bouncer::role()->create([
            'name' => 'assistant',
            'title' => 'Lab Assistant'
            ]);

        $pg = Bouncer::role()->create([
            'name' => 'pg',
            'title' => 'Post Graduate'
            ]);        

        $ug  = Bouncer::role()->create([
            'name' => 'ug',
            'title' => 'Undergraduate'
            ]);

        $as  = Bouncer::role()->create([
            'name' => 'as',
            'title' => 'Academic Staff'
            ]);


        $user = User::find(1);
        Bouncer::assign('dlmsa')->to($user);

        $user = User::find(2);
        Bouncer::assign('admin')->to($user);        

        $user = User::find(3);
        Bouncer::assign('ug')->to($user);

        $user = User::find(4);
        Bouncer::assign('pg')->to($user);

        $user = User::find(5);
        Bouncer::assign('assistant')->to($user);

        $user = User::find(6);
        Bouncer::assign('as')->to($user);
        //Define abilities
        // $viewInventory = Bouncer::ability()->create([
        //     'name' => 'view-inventory',
        //     'title' => 'View Inventory',
        //     ]);








        // $viewLoan = Bouncer::ability()->create([
        //     'name' => 'view-loan',
        //     'title' => 'View Loan',
        //     ]);







        // $viewReservation = Bouncer::ability()->create([
        //     'name' => 'view-reservation',
        //     'title' => 'View Reservation',
        //     ]);








        // $viewInventory = Bouncer::ability()->create([
        //     'name' => 'view-inventory',
        //     'title' => 'View Inventory',
        //     ]);




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
