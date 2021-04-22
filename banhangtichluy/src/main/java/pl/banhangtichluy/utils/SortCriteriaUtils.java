package pl.banhangtichluy.utils;

import com.querydsl.core.types.ExpressionUtils;
import com.querydsl.core.types.Order;
import com.querydsl.core.types.OrderSpecifier;
import com.querydsl.core.types.dsl.Expressions;
import com.querydsl.core.types.dsl.PathBuilder;
import com.querydsl.core.types.dsl.PathBuilderValidator;
import org.springframework.data.domain.Sort;
import org.springframework.data.querydsl.QSort;
import pl.banhangtichluy.dto.criteria.SortCriteria;

import java.util.List;
import java.util.Objects;
import java.util.stream.Collectors;

public class SortCriteriaUtils {

    private static OrderSpecifier getOrderSpecifier(PathBuilder entityPath, SortCriteria criteria) {

        String key = criteria.getKey();
        String direction = criteria.getDirection().toLowerCase();

        try {
            PathBuilder<Object> propPath = null;
            String props[] = key.split("\\.");
            for (String prop : props) {
                propPath = (propPath == null ? entityPath.get(prop) : propPath.get(prop));
            }
            return new OrderSpecifier(
                    direction.equals("desc") ? Order.DESC : Order.ASC,
                    propPath
            ).nullsLast();
        } catch (IllegalArgumentException e) {
            return null;
        }
    }

    public static <T> List<OrderSpecifier> getOrderSpecifiers(PathBuilder<T> entityPath, List<SortCriteria> criterias) {
        if (criterias.size() == 0) {
            return null;
        }
        List<OrderSpecifier> result = criterias.stream().map(criteria -> getOrderSpecifier(entityPath, criteria)).filter(Objects::nonNull).collect(Collectors.toList());
        return result;
    }
}
