<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserImage;
use App\Models\UserDetail;
use App\Models\UserCovidCertificate;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        $sysAd1 = User::create([
            // 'user_image_id' => 1,
            'nip' => '11060000027',
            'name' => 'Luthfi F. Nugroho',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 1,
            'username' => 'luthfi',
            'email' => 'luthfi.nugroho@sinergi-nusantara.co.id',
            'mobile_no' => '0811-1982-298',
            'password' => Hash::make('$K{np#F34dA]'),
            'user_role_id' => 1,
            // 'user_detail_id' => 1,
            // 'user_covid_certificate_id' => 1,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $sysAd1->assignRole('System Administrator');

        UserImage::create([
            'user_id' => 1,
            'name' => 'luthfi.jpg',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 1,
            'created_by' => 'System Administrator',
        ]);

        // UserCovidCertificate::create([
        //     'created_by' => 'System Administrator',
        // ]);

        // 2
        $sysAd2 = User::create([
            // 'user_image_id' => 2,
            'nip' => '21050011803',
            'name' => 'Miftakhussolokhin',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 2,
            'username' => 'Mifta',
            'email' => 'mifta@sinergi-nusantara.co.id',
            'mobile_no' => '0838-7983-6341',
            'password' => Hash::make('xIZf.^c2QQ8y'),
            'user_role_id' => 2,
            // 'user_detail_id' => 2,
            // 'user_covid_certificate_id' => 2,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $sysAd2->assignRole('Administrator');

        UserImage::create([
            'user_id' => 2,
            'name' => 'mifta.jpg',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 2,
            'created_by' => 'System Administrator',
        ]);

        // UserCovidCertificate::create([
        //     'created_by' => 'System Administrator',
        // ]);

        // 3
        $sysAd3 = User::create([
            // 'user_image_id' => 3,
            'nip' => '21050011804',
            'name' => 'Hariyanto Bermula',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 2,
            'username' => 'arya',
            'email' => 'hariyanto.bermula@sinergi-nusantara.co.id',
            'mobile_no' => '0898-7060-567',
            'password' => Hash::make('I76fu,Rcq;aM'),
            'user_role_id' => 2,
            // 'user_detail_id' => 3,
            // 'user_covid_certificate_id' => 3,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $sysAd3->assignRole('Administrator');

        UserImage::create([
            'user_id' => 3,
            'name' => 'arya.jpg',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 3,
            'created_by' => 'System Administrator',
        ]);

        // UserCovidCertificate::create([
        //     'created_by' => 'System Administrator',
        // ]);

        // 4
        $sysAd4 = User::create([
            // 'user_image_id' => 4,
            'nip' => '220113552',
            'name' => 'Wahyu Afendi',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 2,
            'username' => 'wahyu',
            'email' => 'wahyu.afendi@sinergi-nusantara.co.id',
            'mobile_no' => '0896-3610-3371',
            'password' => Hash::make('ZYvsG!dCi1hC'),
            'user_role_id' => 2,
            // 'user_detail_id' => 4,
            // 'user_covid_certificate_id' => 4,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $sysAd4->assignRole('Administrator');

        UserImage::create([
            'user_id' => 4,
            'name' => 'unknown.png',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 4,
            'created_by' => 'System Administrator',
        ]);

        // UserCovidCertificate::create([
        //     'created_by' => 'System Administrator',
        // ]);

        // 5
        $sysAd5 = User::create([
            // 'user_image_id' => 5,
            'nip' => '19100010453',
            'name' => 'Pandu R. Maulana',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 2,
            'username' => 'pandu',
            'email' => 'pandu.maulana@sinergi-nusantara.co.id',
            'mobile_no' => '0822-6152-4242',
            'password' => Hash::make('4A2LMH(61=sb'),
            'user_role_id' => 2,
            // 'user_detail_id' => 5,
            // 'user_covid_certificate_id' => 5,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $sysAd5->assignRole('Administrator');

        UserImage::create([
            'user_id' => 5,
            'name' => 'pandu.jpg',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 5,
            'created_by' => 'System Administrator',
        ]);

        // UserCovidCertificate::create([
        //     'created_by' => 'System Administrator',
        // ]);

        // 6
        $head = User::create([
            // 'user_image_id' => 6,
            'nip' => '1901T00001',
            'name' => 'Asri Insani',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 3,
            'username' => 'head',
            'email' => 'head.surveyor@absolute-services.co.id',
            'mobile_no' => '0811-1515-133',
            'password' => Hash::make('p;roNSc#wOUt'),
            'user_role_id' => 3,
            // 'user_detail_id' => 6,
            // 'user_covid_certificate_id' => 6,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $head->assignRole('Head');

        UserImage::create([
            'user_id' => 6,
            'name' => 'unknown.png',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 6,
            'created_by' => 'System Administrator',
        ]);

        // UserCovidCertificate::create([
        //     'created_by' => 'System Administrator',
        // ]);

        // 7
        $spv = User::create([
            // 'user_image_id' => 7,
            'nip' => '2001T00004',
            'name' => 'Indri Sangga',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 4,
            'username' => 'spv',
            'email' => 'spv.surveyor@absolute-services.co.id',
            'mobile_no' => '0811-1515-133',
            'password' => Hash::make('l]7k@WrV1s,g'),
            'user_role_id' => 4,
            // 'user_detail_id' => 7,
            // 'user_covid_certificate_id' => 7,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $spv->assignRole('Supervisor');

        UserImage::create([
            'user_id' => 7,
            'name' => 'indri.webp',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 7,
            'created_by' => 'System Administrator',
        ]);

        // UserCovidCertificate::create([
        //     'created_by' => 'System Administrator',
        // ]);

        // 8
        $supp = User::create([
            // 'user_image_id' => 8,
            'nip' => '2201T00026',
            'name' => 'Mutia Apriani',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 5,
            'username' => 'support',
            'email' => 'support.surveyor@absolute-services.co.id',
            'mobile_no' => '0811-1515-133',
            'password' => Hash::make('t3&DXyU-szxa'),
            'user_role_id' => 5,
            // 'user_detail_id' => 8,
            // 'user_covid_certificate_id' => 8,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $supp->assignRole('Support');

        UserImage::create([
            'user_id' => 8,
            'name' => 'mutia.webp',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 8,
            'created_by' => 'System Administrator',
        ]);

        // UserCovidCertificate::create([
        //     'created_by' => 'System Administrator',
        // ]);

        // 9
        $admin = User::create([
            // 'user_image_id' => 9,
            'nip' => '1901T00016',
            'name' => 'Pipit Rahayu',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 6,
            'username' => 'admin',
            'email' => 'admin.surveyor@absolute-services.co.id',
            'mobile_no' => '0811-1515-133',
            'password' => Hash::make('nx!Zy8c7.ZX#'),
            'user_role_id' => 6,
            // 'user_detail_id' => 9,
            // 'user_covid_certificate_id' => 9,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $admin->assignRole('Admin');

        UserImage::create([
            'user_id' => 9,
            'name' => 'pipit.webp',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 9,
            'created_by' => 'System Administrator',
        ]);

        // UserCovidCertificate::create([
        //     'user_id' => 9,
        //     'created_by' => 'System Administrator',
        // ]);

        // 10
        $surv1 = User::create([
            // 'user_image_id' => 10,
            'nip' => '1901T00013',
            'name' => 'Dwiyana Adipoetra',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 7,
            'username' => 'dwi',
            'email' => 'adipoetra1807@gmail.com',
            'mobile_no' => '0856-8862-556',
            'password' => Hash::make('12345678'),
            'user_role_id' => 8,
            'team_id' => 1,
            // 'user_detail_id' => 10,
            // 'user_covid_certificate_id' => 10,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $surv1->assignRole('Surveyor');

        UserImage::create([
            'user_id' => 10,
            'name' => 'dwi.webp',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 10,
            'created_by' => 'System Administrator',
        ]);

        UserCovidCertificate::create([
            'user_id' => 10,
            'name' => 'dwiyana_adipoetra.jpeg',
            'created_by' => 'System Administrator',
        ]);

        // 11
        $surv2 = User::create([
            // 'user_image_id' => 11,
            'nip' => '1901T00020',
            'name' => 'Wulung Sujayanto',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 7,
            'username' => 'wulung',
            'team_id' => 2,
            'email' => 'lung.8301@gmail.com',
            'mobile_no' => '0812-9733-3336',
            'password' => Hash::make('wulung12345678'),
            'user_role_id' => 8,
            // 'user_detail_id' => 11,
            // 'user_covid_certificate_id' => 11,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $surv2->assignRole('Surveyor');

        UserImage::create([
            'user_id' => 11,
            'name' => 'wulung.webp',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 11,
            'created_by' => 'System Administrator',
        ]);

        UserCovidCertificate::create([
            'user_id' => 11,
            'name' => 'wulung_sujayanto.jpeg',
            'created_by' => 'System Administrator',
        ]);

        // 12
        $surv3 = User::create([
            // 'user_image_id' => 12,
            'nip' => '1901T00018',
            'name' => 'Andi Permana',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 7,
            'username' => 'andi',
            'email' => 'andipermana532@gmail.com',
            'mobile_no' => '0813-8540-8178',
            'password' => Hash::make('andi12345678'),
            'user_role_id' => 7,
            'team_id' => 1,
            // 'user_detail_id' => 12,
            // 'user_covid_certificate_id' => 12,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $surv3->assignRole('Surveyor');

        UserImage::create([
            'user_id' => 12,
            'name' => 'andi.webp',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 12,
            'created_by' => 'System Administrator',
        ]);

        UserCovidCertificate::create([
            'user_id' => 12,
            'name' => 'andi_permana.jpeg',
            'created_by' => 'System Administrator',
        ]);

        // 13
        $surv4 = User::create([
            // 'user_image_id' => 13,
            'nip' => '1901T00011',
            'name' => 'R. Arief Ajigunara',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 7,
            'username' => 'arief',
            'team_id' => 1,
            'email' => 'arief.damanik92@gmail.com',
            'mobile_no' => '0877-8396-6944',
            'password' => Hash::make('arif12345678'),
            'user_role_id' => 7,
            // 'user_detail_id' => 13,
            // 'user_covid_certificate_id' => 13,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $surv4->assignRole('Surveyor');

        UserImage::create([
            'user_id' => 13,
            'name' => 'arief.webp',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 13,
            'created_by' => 'System Administrator',
        ]);

        UserCovidCertificate::create([
            'user_id' => 13,
            'created_by' => 'System Administrator',
        ]);

        // 14
        $surv5 = User::create([
            // 'user_image_id' => 14,
            'nip' => '1901T00019',
            'name' => 'Valdi Oktariez',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 7,
            'username' => 'valdi',
            'email' => 'voktariez43@gmail.com',
            'mobile_no' => '0812-1296-7414',
            'password' => Hash::make('valdi12345678'),
            'user_role_id' => 7,
            'team_id' => 2,
            // 'user_detail_id' => 14,
            // 'user_covid_certificate_id' => 14,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $surv5->assignRole('Surveyor');

        UserImage::create([
            'user_id' => 14,
            'name' => 'valdi.webp',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 14,
            'created_by' => 'System Administrator',
        ]);

        UserCovidCertificate::create([
            'user_id' => 14,
            'name' => 'valdi_oktariez.jpeg',
            'created_by' => 'System Administrator',
        ]);

        // 15
        $surv6 = User::create([
            // 'user_image_id' => 15,
            'nip' => '1901T00012',
            'name' => 'Danang Dewandari',
            'company_id' => 1,
            'department_id' => 1,
            'job_position_id' => 7,
            'username' => 'danang',
            'email' => 'danangdewandari05@gmail.com',
            'mobile_no' => '0812-5988-0839',
            'password' => Hash::make('danang12345678'),
            'user_role_id' => 7,
            'team_id' => 2,
            // 'user_detail_id' => 15,
            // 'user_covid_certificate_id' => 15,
            'is_active' => 1,
            'is_logged_in' => 0,
            'created_by' => 'System Administrator',
        ]);

        $surv6->assignRole('Surveyor');

        UserImage::create([
            'user_id' => 15,
            'name' => 'danang.webp',
            'created_by' => 'System Administrator',
        ]);

        UserDetail::create([
            'user_id' => 15,
            'created_by' => 'System Administrator',
        ]);

        UserCovidCertificate::create([
            'user_id' => 15,
            'name' => 'danang_dewandari.jpeg',
            'created_by' => 'System Administrator',
        ]);

    }
}
