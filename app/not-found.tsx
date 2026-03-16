"use client";

import { useState } from "react";
import Link from "next/link";
import { type Lang, t } from "@/lib/translations";

export default function NotFound() {
  const [lang] = useState<Lang>("uk");

  return (
    <div className="app-layout">
      <main className="app-main">
        <div className="not-found-page">
          <section className="not-found-card">
            <div className="not-found-icon" aria-hidden="true">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="34"
                height="34"
                viewBox="0 0 24 24"
                fill="currentColor"
              >
                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M11 7H13V13H11V7M11 15H13V17H11V15Z" />
              </svg>
            </div>
            <div className="not-found-code">404</div>
            <h1>{t(lang, "not_found_title")}</h1>
            <p>{t(lang, "not_found_message")}</p>
            <Link href="/" className="not-found-button">
              {t(lang, "back_to_generator")}
            </Link>
          </section>
        </div>
      </main>
    </div>
  );
}
