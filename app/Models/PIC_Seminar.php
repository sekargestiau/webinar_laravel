<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data_Pendaftaran;

class PIC_Seminar extends Model
{
    use HasFactory;
    protected $table = "pic_seminar";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'nama_seminar',
        'deskripi_seminar',
        'lokasi_seminar',
        'gmaps_seminar',
        'tanggal_seminar',
        'gratis_berbayar',
        'vidcon_seminar',
        'tgl_pendaftaran_awal',
        'tgl_pendaftaran_akhir',
        'setup_tgl_unduh',
        'sertifikat',
        'poster', 
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function pembicara()
    {
        return $this->hasMany(Pembicara::class, 'id_pic_seminar');
    }
    public function dataPendaftaran()
    {
        return $this->hasMany(Data_Pendaftaran::class, 'id_pic_seminar', 'id');

    }
}
