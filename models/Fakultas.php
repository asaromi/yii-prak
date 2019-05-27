<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%fakultas}}".
 *
 * @property int $id_fakultas ID Fakultas
 * @property int $nama_fakultas Nama Fakultas
 *
 * @property Prodi[] $prodis
 * @property User[] $users
 */
class Fakultas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%fakultas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_fakultas', 'nama_fakultas'], 'required'],
            [['id_fakultas', 'nama_fakultas'], 'integer'],
            [['id_fakultas'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_fakultas' => Yii::t('app', 'ID Fakultas'),
            'nama_fakultas' => Yii::t('app', 'Nama Fakultas'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdis()
    {
        return $this->hasMany(Prodi::className(), ['id_fakultas' => 'id_fakultas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['fakultas' => 'id_fakultas']);
    }
}
