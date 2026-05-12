<?php

namespace App\Adapters;

use App\Models\Database;
use PDO;

class MySQLLocalAdapter
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    // ==================== WATCHLIST ====================
    
    public function addWatchlistItem(int $userId, string $bookKey, string $source, string $titulo, string $autor): void
    {
        $sql = 'INSERT IGNORE INTO watchlist (user_id, book_key, source, titulo, autor) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId, $bookKey, $source, $titulo, $autor]);
    }

    public function removeWatchlistItem(int $userId, string $bookKey): void
    {
        $sql = 'DELETE FROM watchlist WHERE user_id = ? AND book_key = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId, $bookKey]);
    }

    public function getWatchlistByUser(int $userId): array
    {
        $sql = "SELECT * FROM watchlist WHERE user_id = ? AND source IN ('academic', 'scopus', 'sciencedirect') AND book_key NOT LIKE 'local:%' ORDER BY added_at DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    // ==================== COMENTARIOS ====================
    
    public function addComment(int $userId, string $bookKey, string $source, int $rating, string $comentario): void
    {
        $rating = max(0, min(5, $rating));
        
        $sql = 'INSERT INTO comentarios (user_id, book_key, source, rating, comentario) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId, $bookKey, $source, $rating, $comentario]);

        $this->ensureBookStats($bookKey, $source);
        
        $sql = 'UPDATE book_stats SET rating_total = rating_total + ?, rating_count = rating_count + 1 WHERE book_key = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$rating, $bookKey]);
    }

    public function getCommentsByBook(string $bookKey): array
    {
        $sql = 'SELECT c.*, u.nombre FROM comentarios c 
                INNER JOIN usuarios u ON c.user_id = u.id_usuario 
                WHERE c.book_key = ? ORDER BY c.created_at DESC';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$bookKey]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function ensureBookStats(string $bookKey, string $source): void
    {
        $sql = 'INSERT IGNORE INTO book_stats (book_key, source, views, rating_total, rating_count) VALUES (?, ?, 0, 0, 0)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$bookKey, $source]);
    }

    public function getBookStats(string $bookKey): array
    {
        $sql = 'SELECT views, rating_total, rating_count FROM book_stats WHERE book_key = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$bookKey]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$stats) {
            return ['views' => 0, 'rating_total' => 0, 'rating_count' => 0, 'average_rating' => 0];
        }

        $ratingCount = (int) $stats['rating_count'];
        return [
            'views' => (int) $stats['views'],
            'rating_total' => (int) $stats['rating_total'],
            'rating_count' => $ratingCount,
            'average_rating' => $ratingCount > 0 ? round($stats['rating_total'] / $ratingCount, 1) : 0,
        ];
    }

    public function getBookStatsWithComments(string $bookKey): array
    {
        return [
            'stats' => $this->getBookStats($bookKey),
            'comments' => $this->getCommentsByBook($bookKey),
        ];
    }

    public function incrementBookViews(string $bookKey, string $source): void
    {
        $this->ensureBookStats($bookKey, $source);
        $sql = 'UPDATE book_stats SET views = views + 1 WHERE book_key = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$bookKey]);
    }

    // ==================== USUARIOS ====================
    
    public function getUserByEmail(string $email): ?array
    {
        $sql = 'SELECT * FROM usuarios WHERE email = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([mb_strtolower(trim($email))]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public function createUser(string $email, string $nombre, ?string $googleId = null): int
    {
        $sql = 'INSERT INTO usuarios (email, nombre, google_id) VALUES (?, ?, ?)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([mb_strtolower(trim($email)), trim($nombre), $googleId !== null ? trim($googleId) : null]);
        return (int) $this->connection->lastInsertId();
    }

    public function updateUserGoogleId(int $userId, ?string $googleId): void
    {
        $sql = 'UPDATE usuarios SET google_id = ? WHERE id_usuario = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$googleId !== null ? trim($googleId) : null, $userId]);
    }

    public function getUserById(int $id): ?array
    {
        $sql = 'SELECT * FROM usuarios WHERE id_usuario = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

}