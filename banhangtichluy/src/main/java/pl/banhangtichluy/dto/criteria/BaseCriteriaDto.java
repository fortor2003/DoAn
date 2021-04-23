package pl.banhangtichluy.dto.criteria;

import io.swagger.annotations.ApiParam;
import lombok.Getter;
import lombok.Setter;

import javax.validation.constraints.Min;

@Getter
@Setter
public class BaseCriteriaDto {

    @ApiParam(name = "filter", value = "Filter criteria [Syntax is propName1:operation1:value1,propName2:operation2:value2,...]. Ex: use age:gt:17,name:inc:bob to get list persons have age > 17 and name containing bob", example = "age:gt:17,name:inc:'bob'")
    private String filter = null;

    @ApiParam(name = "sort", value = "Sort criteria [Syntax is propName1+,propName2-,...]. Ex: use age+,name- to get list persons with order age ascending and name desencding", example = "age+,name-")
    private String sort = null;

    @Min(value = 1, message = "size must be greater or equal 1")
    @ApiParam(name = "size", value = "length of list results per page. Ex: use value is 10 if you want to get 10 results return", example = "10")
    private int size = 10;

    @Min(value = 0, message = "offset must be greater or equal 0")
    @ApiParam(name = "page", value = "Number of page. Ex: use value is 1 if you want to get second page, first page start by 0", example = "0")
    private int page = 0;

}
