package pl.banhangtichluy;

import com.querydsl.core.types.*;
import com.querydsl.core.types.dsl.BooleanExpression;
import com.querydsl.core.types.dsl.DateExpression;
import com.querydsl.core.types.dsl.DateTemplate;
import com.querydsl.core.types.dsl.Expressions;
import com.querydsl.jpa.JPQLQuery;
import com.querydsl.jpa.impl.JPAQueryFactory;
import com.querydsl.sql.DatePart;
import com.querydsl.sql.SQLExpressions;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Sort;
import org.springframework.data.querydsl.QSort;
import org.springframework.test.context.ActiveProfiles;
import pl.banhangtichluy.dto.views.v2.*;
import pl.banhangtichluy.entity.QAmount;
import pl.banhangtichluy.entity.QUser;
import pl.banhangtichluy.reponsitory.AmountRepository;
import pl.banhangtichluy.reponsitory.AmountRepository2;

import java.sql.SQLException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
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
    @Autowired
    SimpleDateFormat simpleDateFormat;

    @Test
    void contextLoads() throws ParseException {
        QAmount qAmount = QAmount.amount;
        QUser qUser = QUser.user;
//
        List<OrderSpecifier> orderSpecifiers = new ArrayList<>();
        orderSpecifiers.add(qAmount.value.asc());
//        orderSpecifiers.add(qAmount.createdBy.firstName.desc());
        Sort sort = new QSort(orderSpecifiers.toArray(new OrderSpecifier[0]));

        Date date = simpleDateFormat.parse("2021-04-10");
        BooleanExpression booleanExpressions = SQLExpressions.datetrunc(DatePart.day, qAmount.createdAt).eq(date);
        JPQLQuery<AmountBaseView> fa = query
                .from(qAmount)
                .where(booleanExpressions)
                .select(AmountBaseView.PROJECTIONS);
        Page<AmountBaseView> page = amountRepository2.findAll(fa, PageRequest.of(0,10, sort));
        System.out.println(page);
    }

}
