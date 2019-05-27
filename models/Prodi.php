<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%prodi}}".
 *
 * @property int $id_prodi
 * @property string $nama_prodi
 * @property int $id_fakultas
 *
 * @property Fakulta $fakultas
 * @property User[] $users
 */
class Prodi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%prodi}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prodi', 'nama_prodi', 'id_fakultas'], 'required'],
            [['id_prodi', 'id_fakultas'], 'integer'],
            [['nama_prodi'], 'string', 'max' => 50],
            [['id_prodi'], 'unique'],
            [['id_fakultas'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::className(), 'targetAttribute' => ['id_fakultas' => 'id_fakultas']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_prodi' => Yii::t('app', 'Id Prodi'),
            'nama_prodi' => Yii::t('app', 'Nama Prodi'),
            'id_fakultas' => Yii::t('app', 'Id Fakultas'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakultas()
    {
        return $this->hasOne(Fakulta::className(), ['id_fakultas' => 'id_fakultas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['prodi' => 'id_prodi']);
    }
}
