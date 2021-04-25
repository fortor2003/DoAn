package pl.banhangtichluy.reponsitory;

import org.springframework.data.jpa.repository.JpaRepository;
import pl.banhangtichluy.entity.Permission;
import pl.banhangtichluy.querydsl.ExtendedQuerydslPredicateExecutor;

public interface PermissionRepository extends JpaRepository<Permission, Long>, ExtendedQuerydslPredicateExecutor<Permission> {

}
