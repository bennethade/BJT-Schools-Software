<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    static public function getSingle()
    {
        return self::find(1);
    }


    public function getLogo()
    {
        if(!empty($this->logo) && file_exists('upload/setting/'.$this->logo))
        {
            return url('upload/setting/'.$this->logo);
        }
        else
        {
            return '';
        }

    }


    public function getSeal()
    {
        if(!empty($this->seal) && file_exists('upload/setting/'.$this->seal))
        {
            return url('upload/setting/'.$this->seal);
        }
        else
        {
            return '';
        }

    }


    public function getTrophy()
    {
        if(!empty($this->trophy) && file_exists('upload/setting/'.$this->trophy))
        {
            return url('upload/setting/'.$this->trophy);
        }
        else
        {
            return '';
        }

    }


    public function getFavicon()
    {
        if(!empty($this->favicon_icon) && file_exists('upload/setting/'.$this->favicon_icon))
        {
            return url('upload/setting/'.$this->favicon_icon);
        }
        else
        {
            return '';
        }

    }


    public function getQrCode()
    {
        if(!empty($this->qr_code) && file_exists('upload/setting/'.$this->qr_code))
        {
            return url('upload/setting/'.$this->qr_code);
        }
        else
        {
            return '';
        }

    }


    public function getBarcode()
    {
        if(!empty($this->barcode) && file_exists('upload/setting/'.$this->barcode))
        {
            return url('upload/setting/'.$this->barcode);
        }
        else
        {
            return '';
        }

    }


    public function getAccountantSignature()
    {
        if(!empty($this->accountant_signature) && file_exists('upload/setting/'.$this->accountant_signature))
        {
            return url('upload/setting/'.$this->accountant_signature);
        }
        else
        {
            return '';
        }

    }



    public function getHeadOfSchoolSignature()
    {
        if(!empty($this->head_of_school_signature) && file_exists('upload/setting/'.$this->head_of_school_signature))
        {
            return url('upload/setting/'.$this->head_of_school_signature);
        }
        else
        {
            return '';
        }

    }


}
