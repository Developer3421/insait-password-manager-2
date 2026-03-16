"use client";

import { useState } from "react";
import { type Lang } from "@/lib/translations";
import PasswordGenerator from "@/components/PasswordGenerator";

const LANGS: { code: Lang; flag: string; label: string }[] = [
  { code: "en", flag: "🇬🇧", label: "EN" },
  { code: "uk", flag: "🇺🇦", label: "UK" },
  { code: "ru", flag: "🇷🇺", label: "RU" },
  { code: "tr", flag: "🇹🇷", label: "TR" },
  { code: "de", flag: "🇩🇪", label: "DE" },
];

export default function Home() {
  const [lang, setLang] = useState<Lang>("uk");

  return (
    <div className="app-layout">
      <header className="app-header">
        <div className="lang-switcher">
          {LANGS.map(({ code, flag, label }) => (
            <button
              key={code}
              className={`lang-btn${lang === code ? " active" : ""}`}
              onClick={() => setLang(code)}
            >
              {flag} {label}
            </button>
          ))}
        </div>
      </header>
      <main className="app-main">
        <PasswordGenerator lang={lang} />
      </main>
    </div>
  );
}
