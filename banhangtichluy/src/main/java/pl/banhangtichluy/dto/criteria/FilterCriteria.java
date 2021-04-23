package pl.banhangtichluy.dto.criteria;

import lombok.Builder;
import lombok.Data;

@Data
@Builder
public class FilterCriteria {
    private String key;
    private String operation;
    private Object value;

}
