ALTER TABLE `user_role`
    ADD CONSTRAINT `fk__user_role__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
    ADD CONSTRAINT `fk__user_role__roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `role_permission`
    ADD CONSTRAINT `fk__role_permission__roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
    ADD CONSTRAINT `fk__role_permission__permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `transactions`
    ADD CONSTRAINT `fk__transactions__amounts` FOREIGN KEY (`amount_id`) REFERENCES `amounts` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;