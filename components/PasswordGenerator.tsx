"use client";

import { useCallback, useState } from "react";
import { type Lang, t } from "@/lib/translations";

const UPPERCASE = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
const LOWERCASE = "abcdefghijklmnopqrstuvwxyz";
const DIGITS = "0123456789";
const SYMBOLS = "!@#$%^&*()-_=+[]{}|;:,.<>?";

function computeStrength(length: number, charsetSize: number) {
  const entropy = length * Math.log2(charsetSize);
  if (entropy < 40) return { key: "weak", color: "#FF4444", percent: 20 };
  if (entropy < 60) return { key: "medium", color: "#FFAA00", percent: 50 };
  if (entropy < 80) return { key: "strong", color: "#FF8C00", percent: 75 };
  return { key: "very_strong", color: "#22CC44", percent: 100 };
}

function buildPassword(
  length: number,
  useUppercase: boolean,
  useLowercase: boolean,
  useDigits: boolean,
  useSymbols: boolean
): string {
  let charset = "";
  if (useUppercase) charset += UPPERCASE;
  if (useLowercase) charset += LOWERCASE;
  if (useDigits) charset += DIGITS;
  if (useSymbols) charset += SYMBOLS;
  if (!charset) charset = LOWERCASE;

  const buf = new Uint32Array(length);
  crypto.getRandomValues(buf);
  return Array.from(buf, (v) => charset[v % charset.length]).join("");
}

interface Props {
  lang: Lang;
}

export default function PasswordGenerator({ lang }: Props) {
  const [length, setLength] = useState(16);
  const [useUppercase, setUseUppercase] = useState(true);
  const [useLowercase, setUseLowercase] = useState(true);
  const [useDigits, setUseDigits] = useState(true);
  const [useSymbols, setUseSymbols] = useState(true);
  const [password, setPassword] = useState(() =>
    buildPassword(16, true, true, true, true)
  );
  const [showCopied, setShowCopied] = useState(false);

  const charsetSize =
    (useUppercase ? UPPERCASE.length : 0) +
    (useLowercase ? LOWERCASE.length : 0) +
    (useDigits ? DIGITS.length : 0) +
    (useSymbols ? SYMBOLS.length : 0) || LOWERCASE.length;

  const strength = password
    ? computeStrength(length, charsetSize)
    : { key: "", color: "#AAAAAA", percent: 0 };

  const regenerate = useCallback(
    (
      len: number,
      upper: boolean,
      lower: boolean,
      dig: boolean,
      sym: boolean
    ) => {
      setPassword(buildPassword(len, upper, lower, dig, sym));
      setShowCopied(false);
    },
    []
  );

  const handleLengthChange = (newLength: number) => {
    setLength(newLength);
    regenerate(newLength, useUppercase, useLowercase, useDigits, useSymbols);
  };

  const handleToggleUppercase = () => {
    const next = !useUppercase;
    setUseUppercase(next);
    regenerate(length, next, useLowercase, useDigits, useSymbols);
  };

  const handleToggleLowercase = () => {
    const next = !useLowercase;
    setUseLowercase(next);
    regenerate(length, useUppercase, next, useDigits, useSymbols);
  };

  const handleToggleDigits = () => {
    const next = !useDigits;
    setUseDigits(next);
    regenerate(length, useUppercase, useLowercase, next, useSymbols);
  };

  const handleToggleSymbols = () => {
    const next = !useSymbols;
    setUseSymbols(next);
    regenerate(length, useUppercase, useLowercase, useDigits, next);
  };

  const handleGenerate = () => {
    regenerate(length, useUppercase, useLowercase, useDigits, useSymbols);
  };

  const copyPassword = async () => {
    if (!password) return;
    await navigator.clipboard.writeText(password);
    setShowCopied(true);
    setTimeout(() => setShowCopied(false), 2000);
  };

  return (
    <div className="pg-wrapper">
      {/* Page title */}
      <div className="pg-page-title">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="30"
          height="30"
          viewBox="0 0 24 24"
          fill="#7D2AE8"
        >
          <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,7C13.4,7 14.8,8.1 14.8,9.5V11C15.4,11 16,11.6 16,12.2V15.7C16,16.4 15.4,17 14.7,17H9.2C8.6,17 8,16.4 8,15.7V12.2C8,11.5 8.6,11 9.2,11V9.5C9.2,8.1 10.6,7 12,7M12,8.2C11.2,8.2 10.5,8.7 10.5,9.5V11H13.5V9.5C13.5,8.7 12.8,8.2 12,8.2Z" />
        </svg>
        <h1>{t(lang, "app_title")}</h1>
      </div>

      {/* Password display */}
      <div className="pg-panel">
        <div className="pg-label">{t(lang, "generated_password")}</div>
        <div className="pg-password-row">
          <div className="pg-password-text">{password}</div>
          <div className="pg-copy-area">
            <button className="pg-btn-copy" onClick={copyPassword}>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="14"
                height="14"
                viewBox="0 0 24 24"
                fill="white"
              >
                <path d="M19,21H8V7H19M19,5H8A2,2 0 0,0 6,7V21A2,2 0 0,0 8,23H19A2,2 0 0,0 21,21V7A2,2 0 0,0 19,5M16,1H4A2,2 0 0,0 2,3V17H4V3H16V1Z" />
              </svg>
              {t(lang, "copy")}
            </button>
            {showCopied && (
              <div className="pg-copied-text">{t(lang, "copied")}</div>
            )}
          </div>
        </div>
      </div>

      {/* Strength indicator */}
      <div className="pg-panel pg-strength-panel">
        <div className="pg-strength-header">
          <span>{t(lang, "strength")}</span>
          <strong style={{ color: strength.color }}>
            {strength.key ? t(lang, strength.key) : "—"}
          </strong>
        </div>
        <div className="pg-strength-bar-bg">
          <div
            className="pg-strength-bar-fill"
            style={{
              width: `${strength.percent}%`,
              backgroundColor: strength.color,
            }}
          />
        </div>
      </div>

      {/* Settings */}
      <div className="pg-panel pg-settings-panel">
        {/* Length slider */}
        <div className="pg-setting-group">
          <div className="pg-setting-header">
            <span className="pg-setting-title">{t(lang, "password_length")}</span>
            <span className="pg-length-badge">{length}</span>
          </div>
          <input
            type="range"
            className="pg-slider"
            min={4}
            max={64}
            value={length}
            onChange={(e) => handleLengthChange(Number(e.target.value))}
          />
        </div>

        {/* Character type toggles */}
        <div className="pg-setting-group">
          <div className="pg-setting-title">{t(lang, "characters")}</div>
          <div className="pg-toggles-grid">
            <button
              className={`pg-toggle${useUppercase ? " active" : ""}`}
              onClick={handleToggleUppercase}
            >
              <span className="pg-toggle-main">A–Z</span>
              <span className="pg-toggle-sub">{t(lang, "uppercase")}</span>
            </button>
            <button
              className={`pg-toggle${useLowercase ? " active" : ""}`}
              onClick={handleToggleLowercase}
            >
              <span className="pg-toggle-main">a–z</span>
              <span className="pg-toggle-sub">{t(lang, "lowercase")}</span>
            </button>
            <button
              className={`pg-toggle${useDigits ? " active" : ""}`}
              onClick={handleToggleDigits}
            >
              <span className="pg-toggle-main">0–9</span>
              <span className="pg-toggle-sub">{t(lang, "digits")}</span>
            </button>
            <button
              className={`pg-toggle${useSymbols ? " active" : ""}`}
              onClick={handleToggleSymbols}
            >
              <span className="pg-toggle-main">!@#</span>
              <span className="pg-toggle-sub">{t(lang, "special")}</span>
            </button>
          </div>
        </div>

        {/* Generate button */}
        <button className="pg-btn-generate" onClick={handleGenerate}>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="22"
            height="22"
            viewBox="0 0 24 24"
            fill="white"
          >
            <path d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z" />
          </svg>
          {t(lang, "generate")}
        </button>
      </div>
    </div>
  );
}
