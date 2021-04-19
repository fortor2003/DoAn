package pl.banhangtichluy;

import com.querydsl.core.types.*;
import com.querydsl.core.types.dsl.BooleanExpression;
import com.querydsl.jpa.impl.JPAQueryFactory;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Sort;
import org.springframework.data.querydsl.QSort;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.junit.jupiter.SpringExtension;
import pl.banhangtichluy.dto.views.AmountView;
import pl.banhangtichluy.dto.views.v2.AmountBaseView;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.entity.QAmount;
import pl.banhangtichluy.entity.QUser;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.AmountRepository2;

import javax.persistence.EntityManager;
import java.util.ArrayList;
import java.util.List;

@SpringBootTest
@ActiveProfiles("dev")
class BanhangtichluyApplicationTests {

    @Autowired
    AmountRepository amountRepository;
    @Autowired
    AmountRepository2 amountRepository2;
    @Autowired
    JPAQueryFactory query;

    @Test
    void contextLoads() {
        QAmount qAmount = QAmount.amount;

        List<OrderSpecifier> orderSpecifiers = new ArrayList<>();
        orderSpecifiers.add(qAmount.value.asc());
        orderSpecifiers.add(qAmount.createdBy.firstName.desc());
//
//        Sort sort = orderSpecifiers.toArray(new OrderSpecifier[0]);
        Predicate where = qAmount.createdBy.username.containsIgnoreCase("rdrolf");

        QSort sort = new QSort(orderSpecifiers.toArray(new OrderSpecifier[0]));
        Page<AmountBaseView> page = amountRepository2.findAll(
                Projections.constructor(AmountBaseView.class, qAmount.id, qAmount.type, qAmount.code, qAmount.value),
                where,
                PageRequest.of(0, 10, sort)
        );
        System.out.println("asdasdasdasd");
    }

}
