package pl.banhangtichluy.dto.criteria;

import lombok.Data;

@Data
public class FilterResource {
    private String field;
    private String operator;
    private String value;
}
