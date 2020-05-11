DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

INSERT INTO `brizy`.`users`(`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES (12343928685425123522, 'User Test', 'user@default.app', '$2y$10$HMHF9YXNtMVUGWO8VOqo8OakzY7o4ADZaxstwTCzJF3Q6L3TGzf1q', '2020-04-10 15:18:03', '2020-04-10 15:18:03');
