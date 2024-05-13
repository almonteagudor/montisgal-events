namespace montisgal_events.mvc.Models.Group;

public class EditViewModel
{
    public Guid Id { get; }
    public string? Name { get; set; }
    public string? Description { get; set; }
    public bool IsPublic { get; set; }
}