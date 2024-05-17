namespace montisgal_events.mvc.Models.Groups;

public class CreateViewModel
{
    public string? Name { get; set; }
    public string? Description { get; set; }
    public bool IsPublic { get; set; }
    
    public string? GeneralError { get; set; }
    public string? NameError { get; set; }
    public string? DescriptionError { get; set; }
    public string? IsPublicError { get; set; }
}