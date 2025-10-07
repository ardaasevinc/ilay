## 🎯 Kurumsal Alt Menü Ekleme Rehberi

### Adım 1: Yeni Menü Öğesi Ekle
1. "Yeni Öğe Ekle" butonuna tıklayın
2. Formu aşağıdaki gibi doldurun:

**Alt Menü Örneği 1:**
- Menü Başlığı: `Hakkımızda`
- Tür: `Sayfa`
- Sayfa Seç: (Mevcut sayfalardan birini seçin)
- Üst Menü: `Kurumsal` (Bu önemli!)
- Hedef: `Aynı Sekme`
- Sıralama: `1`
- Görünür: ✅ Aktif

**Alt Menü Örneği 2:**
- Menü Başlığı: `Vizyon & Misyon`
- Tür: `Sayfa`
- Sayfa Seç: (İlgili sayfayı seçin)
- Üst Menü: `Kurumsal`
- Sıralama: `2`
- Görünür: ✅ Aktif

**Alt Menü Örneği 3:**
- Menü Başlığı: `İletişim`
- Tür: `URL`
- URL Adresi: `/iletisim`
- Üst Menü: `Kurumsal`
- Sıralama: `3`
- Görünür: ✅ Aktif

### Sonuç Menü Yapısı:
```
📋 Ana Menü
├── 🏠 Ana Sayfa
├── 🏢 Kurumsal (Ana kategori)
│   ├── 👥 Hakkımızda
│   ├── 🎯 Vizyon & Misyon  
│   └── 📞 İletişim
└── ...diğer menüler
```

### 💡 İpuçları:
1. **Üst Menü** alanını mutlaka doldurun
2. **Sıralama** numaraları ile alt menü sırasını belirleyin
3. **Kurumsal** menüsünün türü "Kategori" olmalı (sadece dropdown için)
4. Alt menüler "Sayfa", "URL" veya "Route" türünde olabilir

### 🔄 Menüyü Test Etme:
Frontend'de menüyü görmek için:
```blade
<x-site.menu location="header" />
```
