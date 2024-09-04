# IMEI Sorgulama

Bu proje, IMEI numaralarının **E-Devlet** üzerinden sorgulanmasını sağlayan basit bir API'dir. Proje, herhangi bir güvenlik amacı taşımamaktadır ve yalnızca test amaçlı geliştirilmiştir. Proje, **bir günde** kodlanmış olup, içerisinde **veritabanına kayıt** işlemi gerçekleştiren herhangi bir method bulunmamaktadır.

### Uyarı
Bu API, **E-Devlet** üzerindeki herkese açık bilgilere dayanarak sorgulama yapar. Kullandığınız web sitesinin **kullanım koşullarını** ve **yasal düzenlemeleri** dikkate almanız gerekmektedir. **Yasadışı kullanımda tüm sorumluluk kullanıcıya aittir.**

---

## Proje Bilgileri

- **Kodlanma Tarihi**: 2016
- **Veri Kaynağı**: [https://www.turkiye.gov.tr/imei-sorgulama](https://www.turkiye.gov.tr/imei-sorgulama)
- **Kullanılan Teknolojiler**: PHP, Guzzle, Laravel, Composer, NPM
- **Veritabanı**: Proje içerisinde herhangi bir veritabanı kullanılmamaktadır.

## Kurulum

Projeyi çalıştırabilmek için aşağıdaki adımları izleyin:

1. **Proje Bağımlılıklarını Yükleyin**
    - PHP bağımlılıkları için:
      ```bash
      composer install
      ```
    - Node.js bağımlılıkları için:
      ```bash
      npm install
      ```

2. **Uygulamayı Başlatın**
    - Laravel'in dahili sunucusunu çalıştırmak için:
      ```bash
      php artisan serve
      ```
    - Uygulama varsayılan olarak `http://127.0.0.1:8000` adresinde çalışacaktır.

## API Kullanımı

### POST İsteği

- **URL**: `http://127.0.0.1:8000/api/public/imei/check`
- **Metot**: `POST`

#### İstek Parametreleri:
| Parametre | Tip   | Açıklama          |
|-----------|-------|-------------------|
| `imei`    | `string` | Sorgulanacak IMEI numarası |

#### Örnek İstek:
```bash
POST http://127.0.0.1:8000/api/public/imei/check
