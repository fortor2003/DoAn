package pl.banhangtichluy.dto.criteria;

import lombok.Builder;
import lombok.Data;
import org.springframework.data.domain.Sort;

@Data
@Builder
public class SortCriteria {
    private String key;
    private String direction;
}
