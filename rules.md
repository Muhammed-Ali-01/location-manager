# PHP Developer Sınama Uygulaması
    - Uygulamanızda konum ekleme, konum listeleme, konumları düzenleme, konumları harita üstünde gösterilmesi ile rota çizgilerinin oluşması uç noktaları olacaktır.
    - Konum Ekleme Uç noktası: Gönderilen bilgiler içinde konumun enlem ve boylam bilgileri, konumun adı ve hexadecimal şekilde marker rengini veritabanına ekleyebilmelidir.
    - Konumları Listeleme Uç Noktası: Kaydedilmiş konumları listeleyen uç noktadır. Listede konumun adı, kullanıcının seçtiği renk ve konum bilgileri olacaktır.
    - Konum Detayı Uç Noktası: Kaydedilmiş konumu tek olarak gösteren uç noktadır.
    - Konum Düzenleme Sayfası: Kaydedilmiş konumların düzenlendiği uç noktadır.
    - Rotalama Uç Noktası: Konumlar gönderilen konuma göre en yakın noktadan başlayarak rotalanacaktır. (Kuş bakışı olarak uzaklık ölçülebilir. Bina ve yollar yoksayılabilir.)

# Kullanılması Gereken Teknolojiler ve Olması Gerekenler
    - Laravel
    - MySQL veya MongoDB
    - Validation Katmanı olmalıdır.
    - Katmanlı mimari oluşturulmalıdır.
    - ORM kullanılmalıdır.
    - Rate Limit mekanizması koyulmalıdır.
    - Proje Dockerize olmalıdır.

# Uyulması Gereken Kurallar
    - Uygulamayı oluştururken yalın kod yazmaya özen gösterin.
    - Repository bağlantısını ilk günden paylaşın. Aksi takdirde değerlendirilmenize olumsuz puan olarak yansır.
    - Önerilen yöntemleri kullanmaya özen gösterin.

# Artı Puan Kazandıracak Nitelikler
    - Uygulama içi testlerin yazılması,
    - Uygulamanın deploy edilmesi.
    - Deploy için pipeline kurulması.
    - Deploy süreçlerinin otomatize edilmesi.
