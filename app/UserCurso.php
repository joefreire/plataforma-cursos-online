<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCurso extends Model
{
    use \Awobaz\Compoships\Compoships;
    protected $fillable = [
        'user_id', 'curso_id', 'andamento', 'data', 'nota', 'data_nota'
    ];
    protected $with       = ['user','curso'];
    public static $rules = array(           
        'user_id' => 'required',
        'curso_id' => 'required',
        'data' => 'required'
    );    

    public $timestamps = true;
    protected $table = 'users_cursos';

    public function curso(){
        return $this->HasOne(Curso::class, 'id', 'curso_id');
    }
    public function user(){
        return $this->HasOne(User::class, 'id', 'user_id');
    }
    public function vendido(){
        return $this->HasOne(VendaProduto::class, ['user_id','produto_id'],['user_id','curso_id']);
    }


    public static function boot() {
        parent::boot();

        static::created(function($UserCurso) {
            $titulo = 'Parabéns '.$UserCurso->user->name.'! O seu curso na Tinele já foi liberado';
            $mensagem = '<p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">'.$UserCurso->user->name.', obrigado por se inscrever no curso "'.$UserCurso->curso->nome.'"!</span></p>
            <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Dispon&iacute;vel 24 hora por dia, Aprenda em qualquer dispositivo, Acesso ilimitado e vital&iacute;cio, Garantia de 30 dias.</span></p>
            <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Pensando em nos aproximamos ainda mais, preparamos algo especial pra voc&ecirc;&hellip; </span></p>
            <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Ao fazer o seu primeiro acesso na nossa plataforma, fa&ccedil;a um v&iacute;deo falando o que voc&ecirc; acha do curso e da plataforma e poste esse v&iacute;deo nas redes sociais com a hashtag: #voc&ecirc;valeoquesabe.</span></p>
            <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">O autor do v&iacute;deo que tiver mais compartilhamentos, curtidas e coment&aacute;rios ganhar&aacute; um dos nossos cursos 100% gr&aacute;tis. Premia&ccedil;&atilde;o feita todo &uacute;ltimo dia de cada m&ecirc;s.</span></p>
            <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Bons estudos!</span></p>
            <p style="line-height: 1.295; margin-top: 0pt; margin-bottom: 8pt;"><span style="font-size: 12pt; font-family: Calibri; color: #000000; background-color: transparent; font-weight: 400; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Alcionildo Fontinele</span></p>';
            \Mail::to($UserCurso->user->email)->queue(new \App\Mail\EmailGeral($UserCurso->user, $titulo, $mensagem));
        });
    }

}
