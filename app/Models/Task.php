<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    /**
     * ステータス（状態）定義
     * const：定数
     */
    const STATUS = [
        1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
        2 => [ 'label' => '着手中', 'class' => 'label-info' ],
        3 => [ 'label' => '完了', 'class' => '' ],
    ];

    /**
     * ステータス（状態）ラベルのアクセサメソッド
     *
     * @return string
     */
    public function getStatusLabelAttribute(): string
    {
        // ステータス（状態）カラムの値を取得する
        $status = $this->attributes['status'];

        // STATUSに定義されていない場合
        if (!isset(self::STATUS[$status])) {
            // 空文字を返す
            return '';
        }
        // STATUSの値（['label']）を返す
        return self::STATUS[$status]['label'];
    }

    /**
     * 状態を表すHTMLクラスのアクセサメソッド
     *
     * @return string
     */
    public function getStatusClassAttribute(): string
    {
        // ステータス（状態）カラムの値を取得する
        $status = $this->attributes['status'];

        // STATUSに定義されていない場合
        if (!isset(self::STATUS[$status])) {
            // 空文字を返す
            return '';
        }
        // STATUSの値（['class']）を返す
        return self::STATUS[$status]['class'];
    }

    /**
     * 整形した期限日のアクセサメソッド
     *
     * @return string
     */
    public function getFormattedDueDateAttribute(): string
    {
        /* Carbon ライブラリを使って期限日の値の形式を変更して返す */
        // createFromFormat()：datetime で指定した文字列を format で指定した書式に沿って解釈した時刻にする関数
        // format()：書式を指定する関数
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }
}
