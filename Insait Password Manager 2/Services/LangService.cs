namespace Insait_Password_Manager_2.Services;

public class LangService
{
    // ── Current language ────────────────────────────────────────────
    public string CurrentLang { get; private set; } = "uk";

    public event Action? OnChange;

    public void SetLang(string lang)
    {
        if (CurrentLang == lang) return;
        CurrentLang = lang;
        OnChange?.Invoke();
    }

    /// <summary>Translates a key using the current language.</summary>
    public string T(string key) =>
        _dict.TryGetValue(CurrentLang, out var d) && d.TryGetValue(key, out var v) ? v : key;

    // ── Dictionaries ────────────────────────────────────────────────
    private static readonly Dictionary<string, Dictionary<string, string>> _dict = new()
    {
        // ── English ────────────────────────────────────────────────
        ["en"] = new()
        {
            ["app_title"]          = "Insait Password Generator",
            ["generated_password"] = "Generated password",
            ["copy"]               = "Copy",
            ["copied"]             = "✓ Copied!",
            ["strength"]           = "Strength:",
            ["weak"]               = "Weak",
            ["medium"]             = "Medium",
            ["strong"]             = "Strong",
            ["very_strong"]        = "Very strong",
            ["password_length"]    = "Password length",
            ["characters"]         = "Characters",
            ["uppercase"]          = "Uppercase",
            ["lowercase"]          = "Lowercase",
            ["digits"]             = "Digits",
            ["special"]            = "Symbols",
            ["generate"]           = "Generate password",
        },

        // ── Ukrainian ──────────────────────────────────────────────
        ["uk"] = new()
        {
            ["app_title"]          = "Insait Password Generator",
            ["generated_password"] = "Згенерований пароль",
            ["copy"]               = "Копіювати",
            ["copied"]             = "✓ Скопійовано!",
            ["strength"]           = "Надійність:",
            ["weak"]               = "Слабкий",
            ["medium"]             = "Середній",
            ["strong"]             = "Сильний",
            ["very_strong"]        = "Дуже сильний",
            ["password_length"]    = "Довжина пароля",
            ["characters"]         = "Символи",
            ["uppercase"]          = "Великі літери",
            ["lowercase"]          = "Малі літери",
            ["digits"]             = "Цифри",
            ["special"]            = "Спецсимволи",
            ["generate"]           = "Генерувати пароль",
        },

        // ── Russian ────────────────────────────────────────────────
        ["ru"] = new()
        {
            ["app_title"]          = "Insait Password Generator",
            ["generated_password"] = "Сгенерированный пароль",
            ["copy"]               = "Копировать",
            ["copied"]             = "✓ Скопировано!",
            ["strength"]           = "Надёжность:",
            ["weak"]               = "Слабый",
            ["medium"]             = "Средний",
            ["strong"]             = "Сильный",
            ["very_strong"]        = "Очень сильный",
            ["password_length"]    = "Длина пароля",
            ["characters"]         = "Символы",
            ["uppercase"]          = "Заглавные",
            ["lowercase"]          = "Строчные",
            ["digits"]             = "Цифры",
            ["special"]            = "Спецсимволы",
            ["generate"]           = "Генерировать пароль",
        },

        // ── Turkish ────────────────────────────────────────────────
        ["tr"] = new()
        {
            ["app_title"]          = "Insait Password Generator",
            ["generated_password"] = "Oluşturulan şifre",
            ["copy"]               = "Kopyala",
            ["copied"]             = "✓ Kopyalandı!",
            ["strength"]           = "Güç:",
            ["weak"]               = "Zayıf",
            ["medium"]             = "Orta",
            ["strong"]             = "Güçlü",
            ["very_strong"]        = "Çok güçlü",
            ["password_length"]    = "Şifre uzunluğu",
            ["characters"]         = "Karakterler",
            ["uppercase"]          = "Büyük harf",
            ["lowercase"]          = "Küçük harf",
            ["digits"]             = "Rakamlar",
            ["special"]            = "Semboller",
            ["generate"]           = "Şifre oluştur",
        },

        // ── German ─────────────────────────────────────────────────
        ["de"] = new()
        {
            ["app_title"]          = "Insait Password Generator",
            ["generated_password"] = "Generiertes Passwort",
            ["copy"]               = "Kopieren",
            ["copied"]             = "✓ Kopiert!",
            ["strength"]           = "Stärke:",
            ["weak"]               = "Schwach",
            ["medium"]             = "Mittel",
            ["strong"]             = "Stark",
            ["very_strong"]        = "Sehr stark",
            ["password_length"]    = "Passwortlänge",
            ["characters"]         = "Zeichen",
            ["uppercase"]          = "Großbuchstaben",
            ["lowercase"]          = "Kleinbuchstaben",
            ["digits"]             = "Ziffern",
            ["special"]            = "Sonderzeichen",
            ["generate"]           = "Passwort generieren",
        },
    };
}

