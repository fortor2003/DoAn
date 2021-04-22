package pl.banhangtichluy.dto.criteria;

import lombok.Data;
import org.springframework.data.domain.Sort;
import org.springframework.data.domain.Sort.Order;

import javax.validation.constraints.Min;
import java.util.ArrayList;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

@Data
public class BaseCriteriaDto {

    private String filter = null;
    private String sort = null;
    @Min(value = 1, message = "size must be greater or equal 1")
    private int size = 10;
    @Min(value = 0, message = "offset must be greater or equal 0")
    private int page = 0;

    public List<SearchCriteria> getSearchCriterias() {
        List<SearchCriteria> result = new ArrayList<>();
        if (filter != null) {
            String[] list = filter.split(",");
            for (String s : list) {
                String[] ingredients = s.split(":");
                SearchCriteria fr = SearchCriteria.builder()
                        .key(ingredients.length > 0 ? ingredients[0] : null)
                        .operation(ingredients.length > 1 ? ingredients[1] : null)
                        .value(ingredients.length > 2 ? ingredients[2] : null)
                        .build();
                result.add(fr);
            }
        }
        return result;
    }

    public List<SortCriteria> getSortCriterias() {
        List<SortCriteria> result = new ArrayList<>();
        if (sort != null) {
            String[] list = sort.split(",");
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

}
