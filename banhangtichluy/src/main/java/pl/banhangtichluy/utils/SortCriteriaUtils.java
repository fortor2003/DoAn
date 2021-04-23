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

import java.util.ArrayList;
import java.util.List;
import java.util.Objects;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.stream.Collectors;

public class SortCriteriaUtils {


    public static List<SortCriteria> getSortCriterias(String sortCriteria) {
        List<SortCriteria> result = new ArrayList<>();
        if (sortCriteria != null) {
            String[] list = sortCriteria.split(",");
            Pattern patternKey = Pattern.compile("[\\w\\.]+");
            Pattern patternDirection = Pattern.compile("[\\+\\-]");
            for (String s : list) {
                Matcher matcherKey = patternKey.matcher(s);
                Matcher matcherDirection = patternDirection.matcher(s);
                if (matcherKey.find()) {
                    result.add(SortCriteria.builder().key(matcherKey.group()).direction(matcherDirection.find() ? (matcherDirection.group().equals("-") ? "desc" : "asc") : "asc").build());
                }
            }
        }
        return result;
    }

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

    public static <T> List<OrderSpecifier> getOrderSpecifiers(PathBuilder<T> entityPath, String sortCriteria) {
        return getOrderSpecifiers(entityPath, getSortCriterias(sortCriteria));
    }

    public static <T> List<OrderSpecifier> getOrderSpecifiers(PathBuilder<T> entityPath, List<SortCriteria> criterias) {
        if (criterias.size() == 0) {
            return new ArrayList<>();
        }
        List<OrderSpecifier> result = criterias.stream().map(criteria -> getOrderSpecifier(entityPath, criteria)).filter(Objects::nonNull).collect(Collectors.toList());
        return result;
    }
}
