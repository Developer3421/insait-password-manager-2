# Insait Password Generator

A secure, static password generator built with [Next.js](https://nextjs.org) and deployed to GitHub Pages.

## Features

- 🔐 Cryptographically secure password generation (`crypto.getRandomValues`)
- 📏 Adjustable password length (4–64 characters)
- 🔠 Toggle character sets: uppercase, lowercase, digits, symbols
- 📊 Real-time strength indicator
- 📋 One-click copy to clipboard
- 🌍 Multi-language support: English, Ukrainian, Russian, Turkish, German

## Getting Started

Install dependencies:

```bash
npm install
```

Run the development server:

```bash
npm run dev
```

Open [http://localhost:3000](http://localhost:3000) to view the app.

## Building for Production

```bash
npm run build
```

This generates a fully static site in the `out/` directory.

## Deployment

The site is automatically deployed to GitHub Pages via GitHub Actions on every push to `main`.

Live URL: `https://developer3421.github.io/insait-password-manager-2/`
