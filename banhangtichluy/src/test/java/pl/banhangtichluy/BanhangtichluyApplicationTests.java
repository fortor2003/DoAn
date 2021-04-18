package pl.banhangtichluy;

import com.querydsl.jpa.impl.JPAQueryFactory;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.junit.jupiter.SpringExtension;
import pl.banhangtichluy.dto.views.AmountView;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.entity.QAmount;
import pl.banhangtichluy.entity.QUser;
import pl.banhangtichluy.entity.User;
import pl.banhangtichluy.reponsitory.AmountRepository;

import javax.persistence.EntityManager;
import java.util.List;

@SpringBootTest
@ActiveProfiles("dev")
class BanhangtichluyApplicationTests {

    @Autowired
    AmountRepository amountRepository;
    @Autowired
    JPAQueryFactory query;

    @Test
    void contextLoads() {
        List<User> list = query
                .selectFrom(QUser.user)

                .where(QUser.user.id.goe(10))
                .fetch();
        Assertions.assertEquals(list.size(), 10);
    }

}
