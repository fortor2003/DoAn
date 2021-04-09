package pl.banhangtichluy.dto.criteria;

import lombok.Data;
import org.springframework.data.domain.Sort;
import org.springframework.data.domain.Sort.Order;
import javax.validation.constraints.Min;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

@Data
public class BaseCriteriaDto {

    private String filter = "";
    private String sort = "";
    @Min(value = 1, message = "size must be greater or equal 1")
    private int size = 10;
    @Min(value = 0, message = "offset must be greater or equal 0")
    private int page = 0;

    public List<FilterResource> getListFilterResource() {
        List<FilterResource> result = new ArrayList<>();
        String[] list = filter.split(",");
        for (String s : list) {
            String[] ingredients = s.split(":");
            FilterResource fr = new FilterResource();
            fr.setField(ingredients.length > 0 ? ingredients[0] : null);
            fr.setOperator(ingredients.length > 1 ? ingredients[1] : null);
            fr.setValue(ingredients.length > 2 ? ingredients[2] : null);
            result.add(fr);
        }
        return result;
    }

    public Sort getSortChain(List<String> allowFields) {
        List<Order> orders = new ArrayList<>();
        String[] list = sort.split(",");
        Pattern patternField = Pattern.compile("\\w+");
        Pattern patternDirection = Pattern.compile("[\\+\\-]");
        for (String s : list) {
            SortResource sr = new SortResource();
            Matcher matcherField = patternField.matcher(s);
            Matcher matcherDirection = patternDirection.matcher(s);
            if (matcherField.find() && allowFields.contains(matcherField.group())) {
                orders.add(new Order(matcherDirection.find() ? (matcherDirection.group().equals("-") ? Sort.Direction.DESC : Sort.Direction.ASC) : Sort.Direction.ASC, matcherField.group()));
            }
        }
        return Sort.by(orders);
    }

}
