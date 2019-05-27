<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id_user
 * @property string $nama
 * @property int $prodi
 * @property int $fakultas
 * @property int $univ
 * @property string $nim
 *
 * @property Prodi $prodi0
 * @property Fakulta $fakultas0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'nama', 'prodi', 'fakultas', 'univ', 'nim'], 'required'],
            [['id_user', 'prodi', 'fakultas', 'univ'], 'integer'],
            [['nama', 'nim'], 'string', 'max' => 50],
            [['id_user'], 'unique'],
            [['prodi'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::className(), 'targetAttribute' => ['prodi' => 'id_prodi']],
            [['fakultas'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::className(), 'targetAttribute' => ['fakultas' => 'id_fakultas']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => Yii::t('app', 'Id User'),
            'nama' => Yii::t('app', 'Nama'),
            'prodi' => Yii::t('app', 'Prodi'),
            'fakultas' => Yii::t('app', 'Fakultas'),
            'univ' => Yii::t('app', 'Univ'),
            'nim' => Yii::t('app', 'Nim'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdi0()
    {
        return $this->hasOne(Prodi::className(), ['id_prodi' => 'prodi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakultas0()
    {
        return $this->hasOne(Fakulta::className(), ['id_fakultas' => 'fakultas']);
    }
}
