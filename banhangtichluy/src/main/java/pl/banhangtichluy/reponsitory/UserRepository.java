package pl.banhangtichluy.reponsitory;

import org.springframework.data.jpa.repository.JpaRepository;
import pl.banhangtichluy.entity.User;

public interface UserRepository extends JpaRepository<User, Long> {

}
