package pl.banhangtichluy.reponsitory;

import com.querydsl.core.types.dsl.StringExpression;
import com.querydsl.core.types.dsl.StringPath;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.querydsl.binding.QuerydslBinderCustomizer;
import org.springframework.data.querydsl.binding.QuerydslBindings;
import org.springframework.data.querydsl.binding.SingleValueBinding;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.entity.QAmount;
import pl.banhangtichluy.querydsl.ExtendedQuerydslPredicateExecutor;

public interface AmountRepository2 extends JpaRepository<Amount, Long>, ExtendedQuerydslPredicateExecutor<Amount> {


}
