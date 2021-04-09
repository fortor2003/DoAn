package pl.banhangtichluy;

import pl.banhangtichluy.entity.Amount_;
import pl.banhangtichluy.utils.ClassUtils;

import javax.persistence.metamodel.SingularAttribute;
import java.util.List;

public class MainTest {
    public static void main(String[] args) {
        List<String> fields = ClassUtils.getFieldNameOfClassHasType(Amount_.class, SingularAttribute.class);
        System.out.println(fields);
    }
}
