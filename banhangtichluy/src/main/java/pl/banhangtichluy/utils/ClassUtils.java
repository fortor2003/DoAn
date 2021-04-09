package pl.banhangtichluy.utils;

import java.lang.reflect.Field;
import java.util.ArrayList;
import java.util.List;

public class ClassUtils {
    public static List<String> getFieldNameOfClassHasType(Class clazz, Class type) {
        List<String> result = new ArrayList<>();
        Field[] fields = clazz.getFields();
        for (Field f : fields) {
            if (f.getType().equals(type)) {
                result.add(f.getName());
            }
        }
        return result;
    }
}
