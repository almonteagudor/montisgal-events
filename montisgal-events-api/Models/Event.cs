namespace montisgal_events_api.Models;

public class Event(Guid id, string name, string? description, DateTime startDate, DateTime? endDate)
{
    public Guid Id { get; set; } = id;
    public string Name { get; set; } = name;
    public string? Description { get; set; } = description;
    public DateTime StartDate { get; set; } = startDate;
    public DateTime? EndDate { get; set; } = endDate;
}