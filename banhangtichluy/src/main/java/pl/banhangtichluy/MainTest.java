package pl.banhangtichluy;

import com.querydsl.core.types.dsl.*;
import pl.banhangtichluy.constants.QuerydslConstant;
import pl.banhangtichluy.entity.Amount;
import pl.banhangtichluy.entity.QAmount;

import java.util.Date;

public class MainTest {
    public static void main(String[] args) {
        PathBuilder<Amount> pathBuilder = new PathBuilder<Amount>(Amount.class, QAmount.amount.getMetadata().getName(), QuerydslConstant.PATH_BUILDER_VALIDATOR);
        PathBuilder<Object> propPath = pathBuilder.get("type");
        String simpleNameOfType = propPath.getType().getSimpleName();
        if (simpleNameOfType.equals("String")) {
            StringPath path = Expressions.stringPath(propPath.getMetadata());
        } else if (simpleNameOfType.toLowerCase().equals("long")) {
            NumberPath<Long> path = Expressions.numberPath(Long.class, propPath.getMetadata());
        } else if (simpleNameOfType.equals("Integer") || simpleNameOfType.equals("int")) {
            NumberPath<Integer> path = Expressions.numberPath(Integer.class, propPath.getMetadata());
        } else if (simpleNameOfType.equals("Date")) {
            DatePath<Date> path = Expressions.datePath(Date.class, propPath.getMetadata());
        }

        System.out.println(pathBuilder);
    }
}
