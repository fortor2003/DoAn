package pl.banhangtichluy.dto.criteria;

import lombok.Data;
import org.springframework.data.domain.Sort;

@Data
public class SortResource {
    private String field;
    private Sort.Direction direction;
}
