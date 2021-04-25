package pl.banhangtichluy.reponsitory;

import org.springframework.data.jpa.repository.JpaRepository;
import pl.banhangtichluy.entity.Role;
import pl.banhangtichluy.querydsl.ExtendedQuerydslPredicateExecutor;

import java.util.List;
import java.util.Optional;

public interface RoleRepository extends JpaRepository<Role, Long>, ExtendedQuerydslPredicateExecutor<Role> {

}
