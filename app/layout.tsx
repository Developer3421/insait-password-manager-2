import type { Metadata } from "next";
import "./globals.css";

export const metadata: Metadata = {
  title: "Insait Password Generator",
  description: "A secure password generator with multi-language support",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body>{children}</body>
    </html>
  );
}
