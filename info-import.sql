

Truncate

TRUNCATE `users`;
TRUNCATE `users_detail`;
TRUNCATE `chat`;
TRUNCATE `message`;
TRUNCATE `message_thread`;
TRUNCATE `message_teacher`;
TRUNCATE `enroll`;
TRUNCATE `doc`;
TRUNCATE `ci_sessions`;
TRUNCATE `ci_sessions_users`;


INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `social_links`, `biography`, `role_id`, `date_added`, `last_modified`, `watch_history`, `wishlist`, `title`, `paypal_keys`, `stripe_keys`, `verification_code`, `status`, `bank_information`, `recaptcha_token`, `date_nac`, `nivel`) VALUES (64, 'Admin ', 'Nilson', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '{"facebook":"#","twitter":"#","linkedin":"#"}', '.', '1', '1588201754', '1602084945', '[]', '[]', 'Estoy para servir ', NULL, NULL, 'd6fb2124567640419f812d883c6177ba', '1', NULL, '', NULL, NULL);



INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `social_links`, `biography`, `role_id`, `date_added`, `last_modified`, `watch_history`, `wishlist`, `title`, `paypal_keys`, `stripe_keys`, `verification_code`, `status`, `bank_information`, `recaptcha_token`, `date_nac`, `nivel`) VALUES (231, 'Tutor', 'Tutor', 'tutor@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '{"facebook":"#","twitter":"#","linkedin":"#"}', '.', '3', '1588201754', '1602084945', '[]', '[]', 'Estoy para servir ', NULL, NULL, 'd6fb2124567640419f812d883c6177ba', '1', NULL, '', NULL, NULL);