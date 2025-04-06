<?php

namespace Modules\Setups\Entities;

use Illuminate\Database\Eloquent\Model;

class SystemInformation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'motto',
        'tagline',
        'address',
        'email',

        'phone',
        'mobile',
        'website',
        'twitter',
        'facebook',
        'instagram',
        'skype',
        'linked_in',
        
        'logo',
        'show_logo_in_report',
        'secondary_logo',
        'icon',

        'test_report_header_title',
        'test_report_header_left_logo',
        'test_report_header_right_logo',
        'test_report_remarks',
        'test_report_notes',
        'test_report_approver',
        'test_report_footer',

        'whatsapp_1',
        'whatsapp_2',
        'banner_text',
        'about_the_company',
        'banner',
        'map',

        'status',
    ];
}
