package pl.banhangtichluy;

import org.junit.BeforeClass;
import org.junit.jupiter.api.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.junit4.SpringRunner;
import pl.banhangtichluy.service.PermissionService;

import java.text.ParseException;
import java.util.List;

import static org.springframework.core.env.AbstractEnvironment.DEFAULT_PROFILES_PROPERTY_NAME;

@RunWith(SpringRunner.class)
@SpringBootTest
@ActiveProfiles("dev")
class BanhangtichluyApplicationTests {


    @BeforeClass
    public static void setupTest() {
        System.setProperty(DEFAULT_PROFILES_PROPERTY_NAME, "test");
    }

//    @Autowired
//    AmountRepository amountRepository;
//    @Autowired
//    AmountRepository2 amountRepository2;
//    @Autowired
//    JPAQueryFactory query;
//    @Autowired
//    SimpleDateFormat simpleDateFormat;
    @Autowired
    PermissionService permissionService;

    @Test
    void contextLoads() throws ParseException {
        List<String> permissionNames = permissionService.getAllPermissionNames();
        System.out.println(permissionNames);
    }

}
