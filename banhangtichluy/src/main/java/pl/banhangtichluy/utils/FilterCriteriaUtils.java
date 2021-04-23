package pl.banhangtichluy.utils;

import com.querydsl.core.types.dsl.*;
import pl.banhangtichluy.dto.criteria.FilterCriteria;

import java.util.ArrayList;
import java.util.List;
import java.util.Objects;
import java.util.stream.Collectors;

public class FilterCriteriaUtils {

    public static List<FilterCriteria> getFilterCriterias(String filterCriteria) {
        List<FilterCriteria> result = new ArrayList<>();
        if (filterCriteria != null) {
            String[] list = filterCriteria.split(",");
            for (String s : list) {
                String[] ingredients = s.split(":");
                FilterCriteria fr = FilterCriteria.builder()
                        .key(ingredients.length > 0 ? ingredients[0] : null)
                        .operation(ingredients.length > 1 ? ingredients[1] : null)
                        .value(ingredients.length > 2 ? ingredients[2] : null)
                        .build();
                result.add(fr);
            }
        }
        return result;
    }

    private static BooleanExpression getPredicate(PathBuilder entityPath, FilterCriteria criteria) {

        String key = criteria.getKey();
        String operation = criteria.getOperation().toLowerCase();
        String value = criteria.getValue().toString();

        try {
            PathBuilder<Object> propPath = null;
            String props[] = key.split("\\.");
            for (String prop : props) {
                propPath = (propPath == null ? entityPath.get(prop) : propPath.get(prop));
            }
            String simpleNameOfType = propPath.getType().getSimpleName();
            if (simpleNameOfType.equals("String")) {
                StringPath path = Expressions.stringPath(propPath.getMetadata());
                switch (operation) {
                    case "eq":
                        return path.equalsIgnoreCase(value);
                    case "neq":
                        return path.notEqualsIgnoreCase(value);
                    case "inc":
                        return path.containsIgnoreCase(value);
                }
            } else if (simpleNameOfType.toLowerCase().equals("long")) {
                NumberPath<Long> path = Expressions.numberPath(Long.class, propPath.getMetadata());
                Long valueLong = Long.parseLong(value);
                switch (operation) {
                    case "eq":
                        return path.eq(valueLong);
                    case "neq":
                        return path.ne(valueLong);
                    case "gt":
                        return path.gt(valueLong);
                    case "gte":
                        return path.goe(valueLong);
                    case "lt":
                        return path.lt(valueLong);
                    case "lte":
                        return path.loe(valueLong);
                }
            } else if (simpleNameOfType.equals("Integer") || simpleNameOfType.equals("int")) {
                NumberPath<Integer> path = Expressions.numberPath(Integer.class, propPath.getMetadata());
                Integer valueInteger = Integer.parseInt(value);
                switch (operation) {
                    case "eq":
                        return path.eq(valueInteger);
                    case "neq":
                        return path.ne(valueInteger);
                    case "gt":
                        return path.gt(valueInteger);
                    case "gte":
                        return path.goe(valueInteger);
                    case "lt":
                        return path.lt(valueInteger);
                    case "lte":
                        return path.loe(valueInteger);
                }
            } else if (simpleNameOfType.equals("Date")) {
                return null;
            }
            return null;
        } catch (IllegalArgumentException e) {
            return null;
        }
    }

    public static <T> BooleanExpression getPredicates(PathBuilder<T> entityPath, String filterCriteria) {
        return  getPredicates(entityPath, getFilterCriterias(filterCriteria));
    }
    
    public static <T> BooleanExpression getPredicates(PathBuilder<T> entityPath, List<FilterCriteria> criterias) {
        if (criterias.size() == 0) {
            return null;
        }
        List<BooleanExpression> predicates = criterias.stream().map(criteria -> getPredicate(entityPath, criteria)).filter(Objects::nonNull).collect(Collectors.toList());
        BooleanExpression result = null;
        for (BooleanExpression predicate : predicates) {
            result = result == null ? predicate : result.and(predicate);
        }
        return result;
    }
}
