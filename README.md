# Word Puzzle Backend 🧩

This is a Laravel 10-based backend application for a Word Puzzle game. It allows students to receive randomized puzzles, submit valid words from those puzzles, and track scores.

---

## 📦 Features

- generates shuffled letter puzzles
- Accepts valid English words (dictionary-based)
- Scores words
- Tracks each student’s submissions
- Displays a leaderboard of top scores

---

## 🚀 Installation

```bash
git clone https://github.com/<your-username>/word-puzzle-backend.git
cd word-puzzle-backend
composer install
cp .env.example .env
php artisan key:generate

## Requirements
1) PHP 8.1
2) Laravel 10.48.29
3) MySQL
4) Composer
