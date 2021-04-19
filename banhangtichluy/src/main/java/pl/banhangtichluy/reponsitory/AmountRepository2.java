package pl.banhangtichluy.reponsitory;

import org.springframework.data.jpa.repository.JpaRepository;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.querydsl.ExtendedQuerydslPredicateExecutor;

public interface AmountRepository2 extends JpaRepository<Amount, Long>, ExtendedQuerydslPredicateExecutor<Amount> {

}
