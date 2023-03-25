<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Birim
 *
 * @property int $birim_id
 * @property string $birim_ad
 * @property string|null $birim_donem
 * @property string $birim_durum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Birim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Birim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Birim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereBirimAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereBirimDonem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereBirimDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereBirimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birim whereUpdatedAt($value)
 */
	class Birim extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Birimhoca
 *
 * @property int $id
 * @property int $kullanici_id
 * @property int $birim_id
 * @property string|null $vazife
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca query()
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereBirimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Birimhoca whereVazife($value)
 */
	class Birimhoca extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $title
 * @property string $aciklama
 * @property string $color
 * @property string $kullanici_name
 * @property string $start
 * @property string $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereAciklama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereKullaniciName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HafizlikHoca
 *
 * @method static \Illuminate\Database\Eloquent\Builder|HafizlikHoca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HafizlikHoca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HafizlikHoca query()
 */
	class HafizlikHoca extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hafizlikders
 *
 * @property int $id
 * @property int $ogrenci_id
 * @property int $kullanici_id
 * @property string|null $hafizlik_sayfa
 * @property string|null $hafizlik_cuz
 * @property string|null $hafizlik_ders
 * @property string|null $hafizlik_topl
 * @property string|null $hafizlik_tarih
 * @property string|null $hafizlik_hata
 * @property string|null $hafizlik_usul
 * @property string|null $hafizlik_durum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikCuz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikDers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikHata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikSayfa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikTarih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikTopl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereHafizlikUsul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikders whereUpdatedAt($value)
 */
	class Hafizlikders extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hafizlikdurum
 *
 * @property int $id
 * @property int $ogrenci_id
 * @property string $hafizlik_durum
 * @property string|null $bast
 * @property string|null $sont
 * @property string|null $hafizlik_son
 * @property int|null $hoca
 * @property string $donus_suresi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereBast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereDonusSuresi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereHafizlikDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereHafizlikSon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereHoca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereSont($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hafizlikdurum whereUpdatedAt($value)
 */
	class Hafizlikdurum extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hocarapor
 *
 * @property int $id
 * @property int $kullanici_id
 * @property int $ogrenci_id
 * @property int $ders_id
 * @property string $hrapor_sayfa
 * @property string $hrapor_ders
 * @property string $hrapor_tarih
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereDersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereHraporDers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereHraporSayfa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereHraporTarih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hocarapor whereUpdatedAt($value)
 */
	class Hocarapor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kullanici
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string|null $kullanici_resim
 * @property string $password
 * @property string $kullanici_dt
 * @property string|null $kullanici_tc
 * @property string|null $kullanici_gsm
 * @property string|null $kullanici_adres
 * @property string|null $kullanici_yetki
 * @property string|null $kullanici_birim
 * @property string|null $kullanici_sinif
 * @property string $kullanici_durum
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciAdres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciBirim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciGsm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciResim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciSinif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciTc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereKullaniciYetki($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kullanici whereUpdatedAt($value)
 */
	class Kullanici extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ogrenci
 *
 * @property int $id
 * @property string $ogrenci_adsoyad
 * @property int|null $kullanici_id
 * @property string $ogrenci_dt
 * @property string|null $ogrenci_tc
 * @property string|null $babaad
 * @property string|null $annead
 * @property string|null $babames
 * @property string|null $annemes
 * @property string|null $babatel
 * @property string|null $annetel
 * @property string|null $ogrenci_tel
 * @property string|null $ogrenci_sehir
 * @property string|null $ogrenci_adres
 * @property string|null $ogrenci_resim
 * @property string|null $ogrenci_kmlk
 * @property string|null $ogrenci_sglk
 * @property string|null $ogrenci_belge1
 * @property string|null $ogrenci_belge2
 * @property string|null $ogrenci_belge3
 * @property string|null $ogrenci_aciklama
 * @property string $ogrenci_yetim
 * @property string $ogrenci_bosanma
 * @property string $ogrenci_kytdurum
 * @property string|null $ayrilma_tarih
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Birim[] $birim_ogrenci
 * @property-read int|null $birim_ogrenci_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Okul[] $okul_ogrenci
 * @property-read int|null $okul_ogrenci_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereAnnead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereAnnemes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereAnnetel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereAyrilmaTarih($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereBabaad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereBabames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereBabatel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereKullaniciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciAciklama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciAdres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciAdsoyad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciBelge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciBelge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciBelge3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciBosanma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciKmlk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciKytdurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciResim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciSehir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciSglk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciTc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereOgrenciYetim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenci whereUpdatedAt($value)
 */
	class Ogrenci extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ogrencibirim
 *
 * @property int $id
 * @property int $ogrenci_id
 * @property int $birim_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereBirimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrencibirim whereUpdatedAt($value)
 */
	class Ogrencibirim extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ogrenciokul
 *
 * @property int $id
 * @property int $ogrenci_id
 * @property int $okul_id
 * @property string|null $aciklama
 * @property string|null $basari
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereAciklama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereBasari($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereOgrenciId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereOkulId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ogrenciokul whereUpdatedAt($value)
 */
	class Ogrenciokul extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Okul
 *
 * @property int $id
 * @property string $okul
 * @property string|null $okul_ad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Okul newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Okul newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Okul query()
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereOkul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereOkulAd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Okul whereUpdatedAt($value)
 */
	class Okul extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $roles_slug
 * @property int|null $parent_id
 * @property int|null $vazife_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RoleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereRolesSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereVazifeId($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RoleUser
 *
 * @property int $id
 * @property int $role_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereUserId($value)
 */
	class RoleUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $kullanici_resim
 * @property string $password
 * @property string|null $telegramId
 * @property string $kullanici_dt
 * @property string|null $kullanici_tc
 * @property string|null $kullanici_gsm
 * @property string|null $kullanici_adres
 * @property string $kullanici_durum
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciAdres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciDurum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciGsm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciResim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKullaniciTc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

